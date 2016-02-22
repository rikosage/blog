<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
use app\models\SubCategory;

class ArticleController extends  Controller
{

  public $enableCsrfValidation = false;

  public function actionIndex()
  {
    return $this->render('index');
  }

  public function actionNew($selected_id = 1)
  {
    $categories = Category::find()
    ->with("subCategory")
    ->all();
    return $this->render('new-article', ['categories' => $categories, 'selected_id' => $selected_id]);
  }

  public function actionCreate()
  {

    $model = new Article();
    $model->load($_POST, "");
    $model->short_content = substr($_POST['full_content'], 0, 5);
    $model->date = date('Y-m-d H:i:s');
    if (!$model->save())
    {
      print_r($model->errors);
    }
  }

}