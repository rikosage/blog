<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Email;
use yii\helpers\Url;

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
        echo "Success";
      }
      else
      {
        print_r($email->errors);
      }
    }
}
