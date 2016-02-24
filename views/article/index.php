<?php use yii\helpers\Url; ?>
<?php $this->title = "Блог" ?>

<div class="col-lg-10 col-lg-offset-1">
  <a class = "btn btn-primary" href="<?=Url::to('/article/new')?>">Создать новую статью</a>
  <a href="<?=Url::to('/category')?>">Просмотр категорий</a>
  <?php foreach ($data as $article): ?>
    <div class="col-lg-12 article">
      <div class="col-lg-6 category">
      <label>Категории:</label>
      <?php if (isset($article->category[0]->id)): ?>
        <a href="<?=Url::to('/article/index?category_id='.$article->category[0]->id)?>">
          <?=$article->category[0]->name?>
        </a>
      <?php else: ?>
        <span class = "bg-danger">Не установлены</span>
      <?php endif ?>
      <?php if (isset($article->subCategory[0]->id)): ?>
        <a href="<?=Url::to('/article/index?sub_category_id='.$article->subCategory[0]->id)?>"><?=$article->subCategory[0]->name?>
        </a>
      <?php endif ?>
      
      </div> 
      <div class="col-lg-6 text-right">
      <label>Теги:</label>
        <?php if (!$article->tags): ?>
          <span class = "bg-danger">Отсутствуют</span>
        <?php endif ?>
          <?php foreach ($article->tags as $tag): ?>
            <a href = "<?=Url::to('/article/index?tag_id='.$tag->id)?>"><?=$tag->name?></a>
          <?php endforeach ?> 
        </div> 
      <div class="content">
        <div class="col-lg-12 text-center">
          <h3>
            <?=$article->title?>
          </h3>
        </div>
        <div class="col-lg-12 text-left"><?=$article->short_content?>...
          <a href="<?=Url::to('/article/show/?id='.$article->id)?>">Открыть</a>
        </div>
        
      </div>
    </div>
  <?php endforeach ?>
</div>