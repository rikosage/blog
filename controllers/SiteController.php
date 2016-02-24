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

  //Отключение CSRF валидации
  public $enableCsrfValidation = false;

  /**
   * Рассылает письма всем подписавшимся юзерам
   * Функция статическая, и вызывается из ArticleController
   *
   * ВНИМАНИЕ! КЛАСС НЕ НАСТРОЕН! 
   * СЕЙЧАС ПИСЬМА РАБОТАЮТ В ТЕСТОВОМ РЕЖИМЕ, СОХРАНЯЯСЬ ЛОКАЛЬНО!
   * 
   * @param  obj $data Содержимое статьи 
   * @return none
   */
  
  public static function sendEmails($data)
  {

    //Получаем все имейлы
    $emails = Email::find()
      ->all();

    foreach ($emails as $user_info):

      $mail = Yii::$app->mailer->compose('mail', ['data'=>$data, 'user_info' => $user_info])
              ->setFrom('no-reply@blog.com')
              ->setTo($user_info->email)
              ->setSubject('Обновление в блоге!');

      //Если что-то сломалось, выплевываем ошибку в удобоваримом виде
      if (!$mail->send()):
        Yii::$app->session->setFlash('errors', $mail->errors);
      endif;
    endforeach;
  }


  /**
   * Когда пользователь подписался на обновления блога
   * @return redirect
   */
  
  public function actionSubscribe()
  {
    $email = new Email;

    if ($email->load($_POST, "") && $email->save()):

      //Уведомляем об успехе
      Yii::$app->session->setFlash('success', "Вы подписаны на обновления!");

    else:

      //Иначе выводим лог ошибок
      Yii::$app->session->setFlash('errors', $email->errors);

    endif;

    $this->redirect(Url::to("/"));

  }

  /**
   * Когда пользователь отписывается от обновлений
   * @return redirect
   */
  
  public function actionUnsubscribe()
  {
    //Определяем имейл, который требуется удалить.
    $email = $_POST['email'];

    //Ищем пользователя
    $result = Email::find()
      ->where("email = '$email'")
      ->one();

    //Если пользователь найден
    if (isset($result)):
      //И если имейл удален
      if ($result->delete()):

      //Уведомляем об успехе
      Yii::$app->session->setFlash('success', "Вы больше не будете получать сообщения");

      else:

      //Иначе выводим лог ошибок
      Yii::$app->session->setFlash('errors', $result->errors);

      endif;
    //Если пользователь с таким имейлом не найден
    else:

      //Выводим лог ошибок
      Yii::$app->session->setFlash('errors', [0=>["Пользователь с таким Email не обнаружен!"]]);

    endif;

    $this->redirect(Url::to("/"));
  }

  /**
   * Метод поиска по строке. Пришлось написать велосипед, решения из коробки не нашел.
   * @return view
   */
  
  public function actionSearch()
  {
    //В этот массив будут записаны совпадающие статьи
    $matches = [];

    //Строка поиска в нижнем регистре. 
    //Стоит отметить, что данная функция почему-то 
    //не действует на кириллицу
    $search = strtolower($_POST['search']);

    //Регулярное выражение по строке поиска.
    $pattern = "/$search/";

    //Вытаскиваем все существующие статьи
    $articles = Article::find()->all();

    //Перебираем статьи
    foreach ($articles as $article):

      //Если находим совпадения в заголовке или тексте статьи
      if (preg_match($pattern, strtolower($article->title)) || 
          preg_match($pattern, strtolower($article->full_content))):

      //Заносим в массив всю статью
      array_push($matches, $article);

      endif;
    endforeach;

    //Если было найдено хоть что-то
    if (count($matches)):

      //Уведомляем об успехе
      Yii::$app->session->setFlash('success', "Результаты поиска по вашему запросу");

    //Иначе выдаем сообщение
    else:

      //Иначе выводим лог ошибок
      Yii::$app->session->setFlash('errors', [0=>["Совпадений не найдено!"]]);
    
    endif;

    //Отрисовываем стандартный view. В случае ошибки view будет пустой, без статей
    //Это не сломалось, это так задумано
    
    return $this->render('/article/index', ['data' => $matches]);
  }
}
