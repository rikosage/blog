<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class Email extends ActiveRecord
{
  public function rules()
  {
    return [
      ['username', 'required'],
      ['username', 'string', 'min'=>3],
      ['email', 'required'],
      //Регулярка для проверки правильности Email. Штатного валидатора не нашел
      ['email', 'match', 'pattern' => '/[\w\d]{3,}[@][a-z]{2,}[.][a-z]{2,6}/'],
    ];
  }

  public static function tableName()
  {
    return "emails";
  }
}