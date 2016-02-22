<?php $this->title = 'Task'; ?>
<?php Yii::$app->language = Yii::$app->session->get('language'); ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <title>Напоминание</title>
  <style>
    .task{
        padding-top: 10px;
        padding-bottom: 10px;
        margin-top: 10px;
        border-radius: 10px;
        border: 1px solid black;
        background: #BBFFC4;
        font-size: 1.3em;
    }

    .date{
    }
  </style>
</head>
<body>
  
</body>
</html>

<header><h2>Вы отправляли на почту напоминания о списке активных дел. Вот они:</h2></header>

<?php foreach ($data as $task){ ?>
  <?php if ($task->status) {?>
    <div class="task">
    <div class="date"><?php echo $task->date; ?></div>
      <div class="title"><?php echo $task->title; ?></div>
      
    </div>
  <?php } ?>
<?php } ?>