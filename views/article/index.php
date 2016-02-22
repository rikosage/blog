<?php use yii\helpers\Url; ?>
<?php $this->title = "Blog" ?>

<a href="<?=Url::to('article/new')?>">Создать новую статью</a>

<?php foreach ($data as $article): ?>
  <div class="row article">
    <div class="col-lg-12 category">
    <a href="<?=$article->category[0]->name?>"><?=$article->category[0]->name?></a>,
    <a href="<?=$article->subCategory[0]->name?>"><?=$article->subCategory[0]->name?></a>
    </div> 
    <div class="content">
      <div class="col-lg-12 text-center"><?=$article->title?></div>
      <div class="col-lg-12 text-left"><?=$article->full_content?></div>
      <a href="<?=Url::to('article/show/?id='.$article->id)?>">Изменить</a>
    </div>
  </div>
<?php endforeach ?>