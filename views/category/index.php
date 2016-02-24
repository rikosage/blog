<?php use yii\helpers\Url; ?>
<?php $this->title = "Категории" ?>

<div class="col-lg-6 col-lg-offset-3">
  <h3>Просмотр категорий</h3>
  
  <?php foreach ($categories as $category): ?>
    <ul>
    <li>
    <?=$category->name?>
    <a href="<?=Url::to('category/remove-category?id='.$category->id)?>">
      <span style = "color: red" class = "glyphicon glyphicon-remove"></span>
    </a>
    </li>
      <?php foreach ($category->subCategory as $subCategory): ?>
        <ul>
        <li>
          <?=$subCategory->name?>
          <a href="<?=Url::to('category/remove-sub-category?id='.$subCategory->id) ?>">
            <span style = "color: orange" class = "glyphicon glyphicon-remove"></span>
          </a>
        </li>
        </ul> 
      <?php endforeach ?>
    
    <form action="<?=Url::to('/category/new-sub-category')?>" method = "post">
      <input type="hidden" name = "category_id" value = "<?=$category->id?>">
      <input name = "name" type="text" placeholder = "Новая подкатегория">
      <button type = "submit">Применить</button>
    </form>
    </ul>
  <?php endforeach ?>
  
  <form action="<?=Url::to('/category/new-category')?>" method = "post">
    <label>Новая категория</label><br/>
    <input name = "name" type="text" placeholder = "Новая категория"><br/>
    <button type = "submit">Применить</button>
  </form>
</div>