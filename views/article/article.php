<?php use yii\helpers\Url; ?>
<?php $this->title = "Статья: ".$data->title ?>

<div class="row">
  <div class="col-lg-9">
    <div class="col-lg-12 article-category text-left">
      <?php if (isset($data->category[0]->id)): ?>
        <a href="<?=Url::to('/article/index?category_id='.$data->category[0]->id)?>">
        <?=$data->category[0]->name?>
      </a>
      <?php else: ?>
        <p class = "bg-danger">Категория не установлена</p>
      <?php endif ?>
      <?php if (isset($data->subCategory[0]->id)): ?>
        <a href="<?=Url::to('/article/index?category_id='.$data->subCategory[0]->id)?>">
        <?=$data->subCategory[0]->name?>
      </a>
      <?php endif ?>
    </div>
    <div class="col-lg-12 article-title text-center"><h3><?=$data->title?></h3></div>
   <div class="col-lg-12 article-content text-left"><p><?=$data->full_content?></p></div>
  </div>
   <div class="col-lg-3">
    <button class = "btn btn-primary form-control">Изменить категории</button>
    <button class = "btn btn-info form-control">Изменить содержимое</button>
    <button class = "btn btn-danger form-control">Удалить статью</button>
  </div>
</div>