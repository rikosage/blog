<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="col-lg-6 text-left">
  <a href="<?=Url::to('/')?>">На главную</a>
</div>
<div class="col-lg-6 text-right">
  <a id = "subscribe-link" class = "show-subscribe-container" href="">Подписаться на обновления</a>
</div>
<div class="col-lg-6 col-lg-offset-6 text-right">
  <a id = "unsubscribe-link" class = "show-subscribe-container" href="">Отписаться от обновлений</a>
</div>
<div class="wrap">
  <div class="screen-lock"></div>
  <div class="search-container col-lg-2">
  <form action="<?=Url::to('/site/search')?>" method = "post">
    <label>Поиск</label><br>
    <input class = "form-control" type="text" name = "search">
    <button>Искать</button>
  </form>
</div>
  <div class="container">
  <div class="subscribe-container">

    <form id = "subscribe-form" action="<?=Url::to('/site/subscribe')?>" method = "post">
      <label class = "username">Как к вам обращаться?</label>
      <input class = "form-control username" type="text" name = "username">
      <label class = "email">Введите Email, на который хотите получать обновления.</label>
      <input class = "form-control email" type="text" name = "email">
      <button class = "btn btn-success">Подтвердить</button>
    </form>

    <form id = "unsubscribe-form" action="<?=Url::to('/site/unsubscribe')?>" method = "post">
      <label class = "email">Введите Email, на который приходят неугодные обновления</label>
      <input class = "form-control email" type="text" name = "email">
      <button class = "btn btn-danger">Подтвердить</button>
    </form>
  </div>
      <?= Breadcrumbs::widget([
          'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]) ?>
      <?= $content ?>
  </div>
</div>

<footer class="footer">
  <div class="container">
      <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

      <p class="pull-right"><?= Yii::powered() ?></p>
  </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>