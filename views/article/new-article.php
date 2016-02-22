<?php use yii\helpers\Url; ?>
<?php $this->title = "Новая статья" ?>

<div class="row">
  <label>Категория</label>
  <form id = "change-category" action="<?=Url::to('')?>" method = "get">
    <select class = "form-control" name="selected_id">
    <?php foreach ($categories as $category): ?>
      <option
        <?php if ($selected_id == $category->id): ?>
          selected = "selected"
        <?php endif ?>
       value="<?=$category->id?>"><?=$category->name?></option>
    <?php endforeach; ?>
    </select>
  </form>
  
  <select id = "sub_category" class = "form-control" name="sub_category">
    <?php foreach ($categories as $category): ?>
      <?php foreach ($category->subCategory as $sub_category): ?>
        <?php if ($sub_category->category_id == $selected_id): ?>
          <option value="<?=$sub_category->id?>"><?=$sub_category->name?></option>
        <?php endif ?>    
      <?php endforeach ?>
    <?php endforeach ?>
  </select>
</div>
<br/>
<div class="row">
  <form action="<?php echo URL::to('create'); ?>" method = "post">
    <div class="title">
      <label>Название статьи</label><br>
      <input class = "form-control" type="text" name = "title">
    </div>
    <div class="content">
      <label>Текст статьи</label><br>
      <textarea class = "form-control" rows = "10" type="text" name = "full_content"></textarea>
    </div>
    <div class="submit">
      <button id = "add-article" class = "btn btn-success" type = "submit">Добавить статью</button>
    </div>
    <input id = "sub_id" type="hidden" name = "sub_id">
  </form>
</div>