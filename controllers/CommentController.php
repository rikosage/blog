<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Comment;
use yii\helpers\Url;

/**
 * Управление комментариями к статьям
 */
class CommentController extends Controller
{

  //Отключение Csrf валидации
  public $enableCsrfValidation = false;


  /**
   * Добавление нового комментария
   * @param  integer $id Идентификатор статьи, к которой добавляем комментарий
   * @return redirect
   */
  
  public function actionNew($id)
  {

    $comment = new Comment;
    $comment->article_id = $id;

    //Если комментарий добавлен
    if($comment->load($_POST, "") && $comment->save()):

      //Уведомление об успехе
      Yii::$app->session->setFlash('success', "Комментарий добавлен");

    else:

      //Иначе вывести лог ошибок
      Yii::$app->session->setFlash('errors', $comment->errors);

    endif;

    //Возврат на предыдущую страницу
    return $this->redirect(Url::previous());
  }


  /**
   * Удаление комментария
   * @param  integer $id Идентификатор удаляемого комментария
   * @return redirect
   */
  
  public function actionRemove($id)
  {
    $comment = Comment::findOne($id);

    //Если комментарий удален
    if ($comment->delete()):

      //Уведомление об успехе
      Yii::$app->session->setFlash('success', "Комментарий удален");
      

    else:

      //Иначе вывести лог ошибок
      Yii::$app->session->setFlash('errors', $comment->errors);

    endif;

    //Возврат на предыдущую страницу
    return $this->redirect(Url::previous());
  }


}