<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class Category extends ActiveRecord
{

  public function rules()
  {
    return [
      ['name', 'required'],
      ['name', 'string', 'min'=>3],
    ];
  }

  public function getSubCategory()
  {
    return $this->hasMany(SubCategory::className(), ['category_id' => 'id']);
  }

  public static function tableName()
  {
    return "category";
  }
}