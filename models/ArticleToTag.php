<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class ArticleToTag extends ActiveRecord
{

  public function rules()
  {
    return [
      ["article_id", "required"],
      ["tag_id", "required"],
    ];
  }


  public static function tableName()
  {
    return "article-to-tag";
  }
}