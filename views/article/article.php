<?php use yii\helpers\Url; ?>
<?php $this->title = "Статья: ".$data->title ?>

<div class="row">
  <div class="col-lg-9 article-show-container">
  <div class="col-lg-6 article-category text-left">
    <label>Категории:</label>
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
  <div class="col-lg-6 text-right">
  <label>Тэги:</label>
    <?php if (!$data->tags): ?>
          <span class = "bg-danger">Отсутствуют</span>
        <?php endif ?>
    <?php foreach ($data->tags as $tag): ?>
      <a href = "<?=Url::to('/article/index?tag_id='.$tag->id)?>"><?=$tag->name?></a>
      <a href="<?=Url::to('/tag/unset?article_id='.$id.'&tag_id='.$tag->id)?>">
        <span style = "color: red" class = "glyphicon glyphicon-remove"></span>
      </a>
    <?php endforeach ?> 
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
  <div class="article-content">
    <div class="col-lg-12 article-title text-center"><h3><?=$data->title?></h3></div>
    <div class="col-lg-12 article-text text-left"><p><?=$data->full_content?></p></div>
  </div>
  </div>

  <form id = "article-change" action="<?=Url::to('/article/change?id='.$id)?>" method = "post">
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
  <div class="comments col-lg-6">
      <strong>Комментарии:</strong><br/><br/>
      <?php foreach ($data->comments as $comment ): ?>
        <div class="comment-container col-lg-12">
          <div class="col-lg-11 text-left"><strong><?=$comment->nickname?></strong></div>
          <div class="col-lg-1">
            <a href="<?=Url::to('/comment/remove?id='.$comment->id)?>">
            <span style = "color: red" class = "glyphicon glyphicon-remove"></span>
            </a>
          </div>
          <div class="col-lg-12 text-left"><?=$comment->content?></div>
        </div>
      <?php endforeach ?>
      <form action="<?=Url::to('/comment/new?id='.$id)?>" method = "post">
        <div class="new-comment">
          <input class = "form-control" type="text" name = "nickname" placeholder = "Ваше имя">
          <textarea class = "form-control" name="content" placeholder = "Текст нового комментария">
          </textarea>
          <button type = "submit" class = "btn btn-primary">Отправить</button>
        </div>   
      </form>
    </div>
  </div>

   <div class="col-lg-3">
    <button class = "btn btn-primary form-control change-article-button">Изменить</button>
    <button class="btn btn-danger form-control cancel-button">Отменить</button>
    <a href = "<?=Url::to('/article/remove?id='.$id)?>" class = "btn btn-danger form-control delete-article-button">Удалить статью</a>
  </div>
  <div class="col-lg-3 tags-container">
    <label>Выбранные теги будут добавлены к статье</label>
    <form action="<?=Url::to('/tag/new')?>" method = "post">
            <input class = "col-lg-6" type="text" name = "name" placeholder="Новый тег">
            <button class = "btn btn-default">Добавить</button>
          </form>
    <form action="<?=Url::to('/tag/set')?>" method = "post">
      <div>
        <?php for($i = 0; $i < count($tags); $i++): ?>
              <input type="checkbox" name = "tag_id[<?=$i?>]" value = "<?=$tags[$i]->id?>">
              <?=$tags[$i]->name?>
              <a href="<?=Url::to('/tag/remove?id='.$tags[$i]->id)?>">
                <span style = "color: red" class = "glyphicon glyphicon-remove"></span>
              </a>
              <br/>
        <?php endfor; ?>
        <input type="hidden" name = "article_id" value = "<?=$id?>">
        <button type = "submit" class = "btn btn-default">Установить теги</button>
      </div>
    </form>
    
  </div>
 
</div>