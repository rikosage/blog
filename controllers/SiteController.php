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

    public static function sendEmails()
    {
      $emails = Email::find()
        ->all();
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
