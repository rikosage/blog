<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Tag;
use app\models\ArticleToTag;
use yii\helpers\Url;

/**
 * Контроллер для работы с тегами
 */

class TagController extends Controller
{

  //Отключение CSRF валидации
  public $enableCsrfValidation = false;

  /**
   * Метод устанавливает соответствия тегов статьям
   * Стандартной функции не нашел, хотя наверняка есть подобная
   * Поэтому пришлось забить костыль. Поправить при повышении уровня знаний
   * 
   * @return redirect
   */
  
  public function actionSet()
  {

    //Получаем id статьи, к которой добавим теги
    $article_id = $_POST["article_id"];

    if (isset($_POST['tag_id'])):
      //Перебираем все пришедшие теги, который полагается соотнести со статьей
      foreach ($_POST['tag_id'] as $tag_id):

        //Делаем выборку из сводной таблицы, где id статьи и тега совпадают

        $model = ArticleToTag::find()
          ->where("article_id = $article_id AND tag_id = $tag_id")
          ->all();

        //Если подобное отношение уже есть - игнорируем.
        //В самой бд id тега и статьи установлены как составной ключ
        //Если же совпадений не найдено

        if (!$model):

          //Создаем новую запись

          $new = new ArticleToTag;
          $new->article_id = $article_id;
          $new->tag_id = $tag_id;

          //Если новое отношение сохранено
          
          if ($new->save()):

            //Уведомляем об успехе
            Yii::$app->session->setFlash('success', "Теги обновлены");
          else:

            //Иначе выводим лог ошибок
            Yii::$app->session->setFlash('errors', $new->errors);

          endif;

        endif;
          
      endforeach;

    //Если не был выбран ни один тег
    else:
      Yii::$app->session->setFlash('errors', [0=>["Не был выбран ни один тег!"]]);
    endif;


    //Возврат на предыдущую страницу
    return $this->redirect(Url::previous());
  }



  /**
   * Метод удаляет соответствия тегов статьям
   * Пришлось воспользоваться тем же костылем
   * 
   * @param  integer $article_id Идентификатор статьи, у которой нужно убрать тег
   * @param  integer $tag_id     Убираемый тег
   * @return redirect
   */
  
  public function actionUnset($article_id, $tag_id)
  {
    //Ищем запись по прилетевшим id
    $model = ArticleToTag::find()
      ->where("article_id = $article_id AND tag_id = $tag_id")
      ->one();

    //Если совпадения найдены
    if ($model):

      //И совпадения удалены
      if ($model->delete()):

        //Уведомляем об успехе
        Yii::$app->session->setFlash('success', "У статьи удален тег"); 

      else:

        //Иначе выводим лог ошибок
        Yii::$app->session->setFlash('errors', $model->errors);

      endif;

    //Маловероятно, но если совпадений не найдено, значит тег левый, и является мусором
    else:

      //Ищем тег и сразу удаляем
      $trash = Tag::findOne($tag_id);
      $trash->delete();
      
    endif;

    return $this->redirect(Url::previous());
  }


  /**
   * Создает новый тег
   * @return redirect
   */

  public function actionNew()
  {
    $tag = new Tag;

    //Если тег успешно создан
    if ($tag->load($_POST, "") && $tag->save()):

      //Уведомляем об успехе
      Yii::$app->session->setFlash('success', "Тег создан");

    else:

      //Иначе выводим лог ошибок
      Yii::$app->session->setFlash('errors', $tag->errors);

    endif;
    
    //Возвращаем пользователя на предыдующую страницу
    return $this->redirect(Url::previous());

  }

  /**
   * Удаляем существующий тег из базы
   * @param  integer $id Идентификатор удаляемого тега
   * @return redirect
   */
  

  public function actionRemove($id)
  {
    $tag = Tag::findOne($id);

    if ($tag->delete()):

      //Уведомляем об успехе
      Yii::$app->session->setFlash('success', "Тег удален");

    else:

      //Иначе выводим лог ошибок
      Yii::$app->session->setFlash('errors', $tag->errors);

    endif;

    return $this->redirect(Url::previous());
  }
}