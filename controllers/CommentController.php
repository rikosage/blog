<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Comment;
use yii\helpers\Url;

class CommentController extends Controller
{
  public $enableCsrfValidation = false;

  public function actionNew($id)
  {

    $model = new Comment;
    $model->article_id = $id;

    if($model->load($_POST, "") && $model->save())
    {
      $this->redirect(Url::previous());
    }
    else
    {
      print_r($model->errors);
    }
  }

  public function actionRemove($id)
  {
    echo $id;
  }


}