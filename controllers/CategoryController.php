<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\SubCategory;
use yii\helpers\Url;

class CategoryController extends Controller
{
  public function actionIndex()
  {
    $categories = Category::find()
    ->with("subCategory")
    ->all();
    echo "<pre>";
    print_r($categories);
    echo "</pre>";
  }
}