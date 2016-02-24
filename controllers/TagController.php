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
  public $enableCsrfValidation = false;

  public function actionSet()
  {
    $article_id = $_POST["article_id"];
    $result = true;
    foreach ($_POST['tag_id'] as $tag_id)
    {
      $model = ArticleToTag::find()
        ->where("article_id = $article_id AND tag_id = $tag_id")
        ->all();
      if (!$model)
      {
        $new = new ArticleToTag;
        $new->article_id = $article_id;
        $new->tag_id = $tag_id;
        $new->save();
      }
        
    }
      return $this->redirect(Url::previous());
  }

  public function actionUnset($article_id, $tag_id)
  {
    $model = ArticleToTag::find()
      ->where("article_id = $article_id AND tag_id = $tag_id")
      ->one();
    if ($model->delete())
    {
      return $this->redirect(Url::previous());
    }
  }

  public function actionNew()
  {
    $tag = new Tag;

    if ($tag->load($_POST, "") && $tag->save())
    {
      return $this->redirect(Url::previous());
    }
  }

  public function actionRemove($id)
  {
    $tag = Tag::findOne($id);

    if ($tag->delete())
    {
      return $this->redirect(Url::previous());
    }
  }
}