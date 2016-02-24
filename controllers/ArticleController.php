<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
use app\models\SubCategory;
use app\models\Comment;
use app\models\Tag;
use app\models\ArticleToTag;
use yii\helpers\Url;

class ArticleController extends  Controller
{

  //Отключение валидации
  public $enableCsrfValidation = false;


  /**
   * Стартовая страница
   * @param  integer $category_id      Категория из get - запроса
   * @param  integer $sub_category_id  Подкатегория из get - запроса
   * @return view
   */
  
  public function actionIndex($category_id = false, $sub_category_id = false, $tag_id = false)
  {
    //Если в гет-запроса пришла подкатегория, делаем выборку по ней
    if ($sub_category_id):
      $data = Article::find()
        ->with("category", "subCategory")
        ->where("sub_category_id = $sub_category_id")
        ->all();

    //Если пришла категория, делаем выборку по категории
    elseif ($category_id):
      $data = Article::find()
        ->with("category", "subCategory")
        ->where("category_id = $category_id")
        ->all();

    //Если пришел какой либо тег, делаем выборку по тегу.
    //Тут забит костыль, но крепкий. 
    //Подробный комментарий:
    elseif ($tag_id):

      //Вспомогательный массив, в который будут сложены айдишники
      //статей, которым соответствует прилетевший в гет-запросе тег.
      $article_ids = [];

      //Ищем все теги, айди которых соотвествует прилетевшему
      $model = ArticleToTag::find()
        ->where("tag_id = $tag_id")
        ->all();

      //Перебираем их
      foreach ($model as $tag):
        //И заносим айди статей, соответствующих тегу во вспомогательный массив
        array_push($article_ids, $tag->article_id);
      endforeach;

      //Ищем все статьи по получившимся айди
      $data = Article::findAll($article_ids);

    //Если гет-запрос пустой, выводим все статьи
    else:
      $data = Article::find()
        ->with("category", "subCategory")
        ->all();
    endif;
    
    //Отрисовываем view
     return $this->render('index', ['data'=>$data]);
  }

  /**
   * Отрисовка view для добавления статьи
   * @param  integer $selected_id  Айди добавляемой категории
   * @return view
   */
  
  public function actionNew($selected_id = false)
  {

    //Если страница открывается впервые
    if ($selected_id == false):

      //Выбираем самую первую категорию
      $Category = Category::find()->with("subCategory")->one();
      $selected_id = $Category->id;

    endif;

    $categories = Category::find()
    ->with("subCategory")
    ->all();

    return $this->render('new-article', ['categories' => $categories, 
                                         'selected_id' => $selected_id]);
  }


  //Создание новой статьи
  public function actionCreate()
  {

    $model = new Article();
    $model->load($_POST, "");

    //Обрезаем весь текст до определенного символа для превью статьи
    $model->short_content = substr($_POST['full_content'], 0, 
      Yii::$app->params['short_content_length']);
    $model->date = date('Y-m-d H:i:s');

    //Если сохранение прошло успешно
    if ($model->save()):

      //Отправляем уведомления подписавшимся юзерам
      SiteController::sendEmails($model);

      //Уведомляем об успехе
      Yii::$app->session->setFlash('success', "Статья успешно добавлена");

    else:

      //Иначе выводим лог ошибок
      Yii::$app->session->setFlash('errors', $model->errors);

    endif;
    //Возвращаем в корень сайта
    return $this->redirect(Url::to("/"));
  }


  /**
   * Срабатывает при переходе на конкретную статью
   * @param  integer $id          Идентификатор статьи
   * @param  integer $selected_id Вспомогательный id выбранной категории
   * @return view
   */
  public function actionShow($id, $selected_id = false)
  {
    //Запоминаем URL каждый раз при попадании на данный маршрут
    Url::remember();

    //Если страница открывается впервые
    if ($selected_id == false):

      //Выбираем самую первую категорию
      $Category = Category::find()->with("subCategory")->one();
      $selected_id = $Category->id;

    endif;
    
    /**
     * $data хранит в себе выбранную статью со всеми комментариями
     * @var obj
     */

    $data = Article::find()
      ->with("comments")
      ->where("id = $id")
      ->one();

    /**
     * $categories хранит в себе категории, включая подкатегории
     * @var obj
     */
    
    $categories = Category::find()
      ->with("subCategory")
      ->all();

    /**
     * $tags хранит в себе в существующие теги, для вывода их справа
     * @var obj
     */
    
    $tags = Tag::find()->all();

    /**
     * Передаем во view статью, категории, идентификатор категории, теги и текущий id статьи
     */
    return $this->render('article', ['data'=>$data, 'categories'=>$categories, "selected_id"=>$selected_id, "tags"=>$tags , 'id'=>$id]);
  }


  /**
   * Срабатывает при принятии изменений статьи
   * @param  integer $id Идентификатор изменяемой статьи
   * @return redirect
   */
  
  public function actionChange($id)
  {
    $model = Article::findOne($id);
    $model->short_content = substr($_POST["full_content"], 0, 
      Yii::$app->params['short_content_length']);

    //Если статья изменена
    if ($model->load($_POST, "") && $model->save()):

      //Уведомляем об успехе
      Yii::$app->session->setFlash('success', "Содержимое статьи изменено");

    else:

      //Иначе выводим лог ошибок
      Yii::$app->session->setFlash('errors', $model->errors);

    endif;
    
    return $this->redirect(Url::to("/"));
  }

  public function actionRemove($id)
  {

    $article = Article::findOne($id);

    Comment::deleteAll(['article_id'=>$id]);

    //Если статья удалена
    if ($article->delete()):

      //Уведомляем об успехе
      Yii::$app->session->setFlash('success', "Статья удалена");

    else:

      //Иначе выводим лог ошибок
      Yii::$app->session->setFlash('errors', $article->errors);

    endif;

    //Возвращаем на предыдущую страницу
    return $this->redirect(Url::to("/"));
  }
}