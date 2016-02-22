<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;


/**
 * Модель для взаимодействия с таблицей tasks
 */
class Task extends ActiveRecord
{

  //Константы активности
  const STATUS_ACTIVE = 1;
  const STATUS_COMPLETED = 0;


  /**
   * Правила валидации для заданий
   */
  
  public function rules(){
    return 
    [
        ['title', 'required', 'message'=>Yii::t('msg/msg', 'Заголовок обязателен')],
        ['title', 'unique', 'message'=>Yii::t('msg/msg', 'Такое задание уже существует')],
        ['title', "string", 'min'=>3, 'max'=>50, 'tooShort'=>Yii::t('msg/msg', 'Слишком короткое сообщение'), "tooLong"=>Yii::t('msg/msg', 'Слишком длинное сообщение')],
    ];
}
  
  /**
   * Определение связанных с заданием комментариев
   * @return object
   */
  
  public function getComment()
  {
    return $this->hasMany(Comment::className(), ['task_id' => 'id']);
  }


  /**
   * Имя используемой таблицы
   * @return string
   */
  public static function tableName()
  {
    return "tasks";
  }
}

?>