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

    $comment = new Comment;
    $comment->article_id = $id;

    if($comment->load($_POST, "") && $comment->save())
    {
      $this->redirect(Url::previous());
    }
    else
    {
      print_r($comment->errors);
    }
  }

  public function actionRemove($id)
  {
    $comment = Comment::findOne($id);

    if ($comment->delete())
    {
      $this->redirect(Url::previous());
    }
    else
    {
      print_r($comment->errors);
    }
  }


}