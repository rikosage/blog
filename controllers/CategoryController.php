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
    if ($model->load($_POST, "") && $model->save())
    {
      //Вернуться на предыдущую страницу
      $this->redirect(Url::previous());
    }
    else
    {
      //Иначе вывести лог ошибок
      print_r($model->errors);
    }
  }


  //Новая подкатегория
  public function actionNewSubCategory()
  {

    $model = new SubCategory;

    //Если данные из формы загружены и сохранены
    if ($model->load($_POST, "") && $model->save())
    {

      //Вернуться на предыдущую страницу
      $this->redirect(Url::previous());
    }
    else
    {
      //Иначе вывести лог ошибок
      print_r($model->errors);
    }
  }


  //Удаление категории
  public function actionRemoveCategory($id)
  {
    //Выбрать удаляемую категорию из ЬД
    $category = Category::findOne($id);

    //Рекурсивно удалить связанные подкатегории
    SubCategory::deleteAll(['category_id'=>$id]);

    //Если категория удалилась
    if ($category->delete())
    {

      //Переход на предыдущую страницу
      $this->redirect(Url::previous());
    }
    else
    {

      //Иначе вывести лог ошибок
      print_r($category->errors);
    }
  }


  //Удаление подкатегории
  public function actionRemoveSubCategory($id)
  {

    //Выбор удаляемой категории из БД
    $subCategory = SubCategory::findOne($id);

    //Если удалена
    if ($subCategory->delete())
    {

      //Переход на предыдущую страницу
      $this->redirect(Url::previous());
    }
    else
    {

      //Иначе вывести лог ошибок
      print_r($subCategory->errors);
    }
  }
}