<?php $this->title = 'Task'; ?>
<?php Yii::$app->language = Yii::$app->session->get('language'); ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <title>Напоминание</title>
  <style>

  </style>
</head>
<body>
  
</body>
</html>

<header><h2><?=$user_info->username?>, вы получили обновления блога!</h2></header>

<div class="row">
  <div class="col-lg-12 text-center title">
    <h3><?=$data->title?></h3>
  </div>
  <div class="col-lg-2 date text-left"><?=$data->date?></div>
  <div class="col-lg-8 col-lg-offset-2 content">
    <p><?=$data->full_content?></p>
  </div>
</div>