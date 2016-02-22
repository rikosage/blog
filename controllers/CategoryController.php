<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\SubCategory;
use app\models\Article;
use yii\helpers\Url;

class CategoryController extends Controller
{
  public $enableCsrfValidation = false;

  public function actionIndex()
  {
    Url::remember();
    $categories = Category::find()
    ->with("subCategory")
    ->all();
    return $this->render("index", ['categories'=>$categories]);
  }

  public function actionNewCategory()
  {
    $model = new Category;
    if ($model->load($_POST, "") && $model->save())
    {
      $this->redirect(Url::previous());
    }
    else
    {
      print_r($model->errors);
    }
  }

  public function actionNewSubCategory()
  {
    $model = new SubCategory;
    if ($model->load($_POST, "") && $model->save())
    {
      $this->redirect(Url::previous());
    }
    else
    {
      print_r($model->errors);
    }
  }

  public function actionRemoveCategory($id)
  {
    $category = Category::findOne($id);
    SubCategory::deleteAll(['category_id'=>$id]);

    if ($category->delete())
    {
      $this->redirect(Url::previous());
    }
    else
    {
      print_r($category->errors);
    }
  }

  public function actionRemoveSubCategory($id)
  {
    $subCategory = SubCategory::findOne($id);

    if ($subCategory->delete())
    {
      $this->redirect(Url::previous());
    }
    else
    {
      print_r($subCategory->errors);
    }
  }
}