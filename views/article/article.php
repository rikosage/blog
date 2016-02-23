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
    <div class="article-change-category col-lg-12 text-left">
      <form id = "change-category" action="<?=Url::to('')?>" method = "get">
        <input type="hidden" name = "id" value = "<?=$id?>">
        <select id = "category_id" class = "form-control" name="selected_id">
          <?php foreach ($categories as $category): ?>
           <option 
            <?php if ($selected_id == $category->id): ?>
              selected = "selected"
            <?php endif ?>
           value="<?=$category->id?>"><?=$category->name?></option> 
          <?php endforeach ?>
        </select>
      </form>
      <select id = "sub_category" class = "form-control" name="sub_category_id">
        <?php foreach ($categories as $category): ?>
          <?php foreach ($category->subCategory as $sub_category): ?>
            <?php if ($sub_category->category_id == $selected_id): ?>
              <option value="<?=$sub_category->id?>"><?=$sub_category->name?></option>
            <?php endif ?>
          <?php endforeach ?>
        <?php endforeach ?>
      </select>
    </div>
  <div class="article-content">
    <div class="col-lg-12 article-title text-center"><h3><?=$data->title?></h3></div>
    <div class="col-lg-12 article-text text-left"><p><?=$data->full_content?></p></div>
  </div>
  <form action="<?=Url::to('/article/change?id='.$id)?>" method = "post">
    <div class="article-change-content">
      <div class="article-title text-center">
        <input class = "form-control text-center" 
        type="text" 
        name = "title" 
        value = "<?=$data->title?>"/>
      </div>
      <div class="article-text text-left">
        <textarea class = "form-control" name="full_content" rows="10">
          <?=$data->full_content?>
        </textarea>
      </div>
      <button class="btn btn-success">Принять изменения</button>
      <input type="hidden" name = "id" value = "<?=$id?>">
      <input id = "cat_id" type="hidden" name = "category_id" value = "">
      <input id = "sub_id" type="hidden" name = "sub_category_id" value = "">
    </div>
  </form>
  </div>
   <div class="col-lg-3">
    <button class = "btn btn-primary form-control change-article-button">Изменить</button>
    <button class = "btn btn-danger form-control delete-article-button">Удалить статью</button>
  </div>

</div>