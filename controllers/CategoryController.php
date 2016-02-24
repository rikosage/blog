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

  //Отключение валидации
  public $enableCsrfValidation = false;


  //Показать все категории
  public function actionIndex()
  {
    //При попадании на этот маршрут запоминаем URL
    Url::remember();

    //Выборка всех категорий с подкатегориями из БД
    $categories = Category::find()
    ->with("subCategory")
    ->all();

    return $this->render("index", ['categories'=>$categories]);
  }


  //Создание новой категории
  public function actionNewCategory()
  {
    $model = new Category;

    //Если загрузка данных из формы и их сохранение прошли успешно
    if ($model->load($_POST, "") && $model->save()):

      Yii::$app->session->setFlash('success', "Категория добавлена"); 

    else:

      //Иначе вывести лог ошибок
      Yii::$app->session->setFlash('errors', $model->errors);
    endif;

    //Вернуться на предыдущую страницу
    return $this->redirect(Url::previous());
  }


  //Новая подкатегория
  public function actionNewSubCategory()
  {

    $model = new SubCategory;

    //Если данные из формы загружены и сохранены
    if ($model->load($_POST, "") && $model->save()):
      
      //Уведомление об успехе
      Yii::$app->session->setFlash('success', "Подкатегория добавлена");

    else:

      //Иначе вывести лог ошибок
      Yii::$app->session->setFlash('errors', $model->errors);

    endif;

    //Вернуться на предыдущую страницу
    return $this->redirect(Url::previous());
  }


  //Удаление категории
  public function actionRemoveCategory($id)
  {
    //Выбрать удаляемую категорию из ЬД
    $category = Category::findOne($id);

    //Рекурсивно удалить связанные подкатегории
    SubCategory::deleteAll(['category_id'=>$id]);

    //Если категория удалилась
    if ($category->delete()):

      //Уведомление об успехе
      Yii::$app->session->setFlash('success', "Категория удалена");

    else:

      //Иначе вывести лог ошибок
      Yii::$app->session->setFlash('errors', $model->errors);

    endif;

    //Переход на предыдущую страницу
    return $this->redirect(Url::previous());
  }


  //Удаление подкатегории
  public function actionRemoveSubCategory($id)
  {

    //Выбор удаляемой категории из БД
    $subCategory = SubCategory::findOne($id);

    //Если подкатегория удалена
    if ($subCategory->delete()):

      //Уведомление об успехе
      Yii::$app->session->setFlash('success', "Подкатегория удалена");

    else:

      //Иначе вывести лог ошибок
      Yii::$app->session->setFlash('errors', $model->errors);
    endif;

    //Переход на предыдущую страницу
    return $this->redirect(Url::previous());
  }
}