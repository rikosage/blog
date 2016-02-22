<?php use yii\helpers\Url; ?>
<?php $this->title = "Blog" ?>

<a class = "btn btn-primary" href="<?=Url::to('article/new')?>">Создать новую статью</a>
<a href="<?=Url::to('/category')?>">Просмотр категорий</a>

<?php foreach ($data as $article): ?>
  <div class="row article">
    <div class="col-lg-12 category">
    <?php if (isset($article->category[0]->id)): ?>
      <a href="<?=Url::to('/article/index?category_id='.$article->category[0]->id)?>">
        <?=$article->category[0]->name?>
      </a>
    <?php else: ?>
      <p class = "bg-danger">Категория не установлена</p>
    <?php endif ?>
    <?php if (isset($article->subCategory[0]->id)): ?>
      <a href="<?=Url::to('/article/index?sub_category_id='.$article->subCategory[0]->id)?>"><?=$article->subCategory[0]->name?>
      </a>
    <?php endif ?>
    
    </div> 
    <div class="content">
      <div class="col-lg-12 text-center"><?=$article->title?></div>
      <div class="col-lg-12 text-left"><?=$article->short_content?>...
        <a href="<?=Url::to('article/show/?id='.$article->id)?>">Открыть</a>
      </div>
      
    </div>
  </div>
<?php endforeach ?>