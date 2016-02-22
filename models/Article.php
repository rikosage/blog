<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class Article extends ActiveRecord
{

  public function rules(){
    return 
    [
        ['title', 'required'],
        ['title', 'unique'],
        ['full_content', 'required'],
        ['sub_id', 'required'],
    ];
  }

  public static function tableName()
  {
    return "articles";
  }
  
}