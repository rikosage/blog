<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class Comment extends ActiveRecord
{

  public function rules()
  {
    return [
      ['nickname', 'required'],
      ['content', 'required'],
      ['content', 'string', 'min'=>3],
    ];
  }

  

  public static function tableName()
  {
    return "comments";
  }
}