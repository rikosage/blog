<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class Tag extends ActiveRecord
{

  public function rules()
  {
    return [
      ["name", "required"],
      ["name", "string", "min"=>3],
    ];
  }


  public static function tableName()
  {
    return "tags";
  }
}