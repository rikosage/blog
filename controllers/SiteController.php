<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Email;
use yii\helpers\Url;

/**
 * Контроллер общих функций сайта
 */
class SiteController extends Controller
{
  public $enableCsrfValidation = false;

  public static function sendEmails($data)
  {
    $emails = Email::find()
      ->all();

    foreach ($emails as $user_info)
    {
      $mail = Yii::$app->mailer->compose('mail', ['data'=>$data, 'user_info' => $user_info])
              ->setFrom('no-reply@blog.com')
              ->setTo($user_info->email)
              ->setSubject('Обновление в блоге!');

      if ($mail->send())
      {
          echo "Письмо отправлено";
      }
      else
      {
        print_r($mail->errors);
      }
    }
  }

  public function actionSubscribe()
  {
    $email = new Email;

    if ($email->load($_POST, "") && $email->save())
    {
      $this->redirect(Url::previous());
    }
    else
    {
      print_r($email->errors);
    }
  }

  public function actionUnsubscribe()
  {
    $email = $_POST['email'];
    $result = Email::find()
      ->where("email = '$email'")
      ->one();

    if (isset($result))
    {
      if ($result->delete())
      {
        $this->redirect(Url::previous());
      }
      else
      {
        print_r($result->errors);
      }
    }
    else
    {
      echo "Email не найден.";
    }
  }

  /**
   * Метод поиска по строке. Пришлось написать велосипед, решения из коробки не нашел.
   * @return view
   */
  
  public function actionSearch()
  {
    //В этот массив будут записаны совпадающие статьи
    $matches = [];

    //Строка поиска
    $search = strtolower($_POST['search']);

    //Регулярное выражение по строке поиска
    $pattern = "/$search/";

    //Вытаскиваем все существующие статьи
    $articles = Article::find()->all();

    //Перебираем статьи
    foreach ($articles as $article)
    {

      //Если находим совпадения в заголовке или тексте статьи
      if (preg_match($pattern, strtolower($article->title)) || 
          preg_match($pattern, strtolower($article->full_content)))
      {

      //Заносим в массив всю статью
      array_push($matches, $article);
      }
    }

    //Если было найдено хоть что-то
    if (count($matches) != 0)
    {
      //Отрисовываем стандартный view
      return $this->render('/article/index', ['data' => $matches]);
    }
    //Иначе выдаем сообщение
    else
    {
      echo "Совпадений не найдено";
    }

  }
}
