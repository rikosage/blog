<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
use app\models\SubCategory;
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
  public function actionIndex($category_id = false, $sub_category_id = false)
  {
    //Если в гет-запроса пришла подкатегория, делаем выборку по ней
    if ($sub_category_id)
    {
      $data = Article::find()
        ->with("category", "subCategory")
        ->where("sub_category_id = $sub_category_id")
        ->all();
    }

    //Если пришла категория, делаем выборку по категории
    elseif ($category_id)
    {
      $data = Article::find()
        ->with("category", "subCategory")
        ->where("category_id = $category_id")
        ->all();
    }

    //Если гет-запрос пустой, выводим все статьи
    else
    {
      $data = Article::find()
        ->with("category", "subCategory")
        ->all();
    }
    
    //Отрисовываем view
    return $this->render('index', ['data'=>$data]);
  }

  /**
   * Отрисовка view для добавления статьи
   * @param  integer $selected_id  Айди добавляемой категории
   * @return view
   */
  public function actionNew($selected_id = 1)
  {
    $categories = Category::find()
    ->with("subCategory")
    ->all();
    return $this->render('new-article', ['categories' => $categories, 'selected_id' => $selected_id]);
  }


  //Создание новой статьи
  public function actionCreate()
  {

    $model = new Article();
    $model->load($_POST, "");

    //Обрезаем весь текст до 200 символа для превью статьи
    $model->short_content = substr($_POST['full_content'], 0, 200);
    $model->date = date('Y-m-d H:i:s');
    if ($model->save())
    {
      $this->redirect(Url::to("/"));
    }
    else
    {
      print_r($model->errors);
    }
  }


  //Отрисовка view для изменений статьи
  public function actionShow($id)
  {
    $data = Article::findOne($id);
    return $this->render('article', ['data'=>$data]);
  }

}