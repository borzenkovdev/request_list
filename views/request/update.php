<?php

/* @var $this yii\web\View */
use \yii\helpers\Url;

$this->title = 'Заявка № ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Заявка №<?=$model->id;?></h1>

<form method="post">
    <div class="form-group">
        <label for="request_name">Название</label>
        <input type="text" name="Request[name]" class="form-control" id="request_name" placeholder="Тема заявки" value="<?=$model->name;?>">
    </div>
    <div class="form-group">
        <label for="request_descr">Описание</label>
        <textarea class="form-control" id="request_descr" rows="3"  name="Request[description]" ><?=$model->description;?></textarea>
    </div>
    <div class="form-group">
        <label for="request_descr">Описание</label>
        <textarea class="form-control" id="request_descr" rows="3"  name="Request[description]" ><?=$model->description;?></textarea>
    </div>
    <div class="form-group">
        <label for="request_descr">Описание</label>
        <textarea class="form-control" id="request_descr" rows="3"  name="Request[description]" ><?=$model->description;?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>

<?if ($model->created_by == \Yii::$app->user->identity->getId()) :?>
<button type="submit" class="btn btn-primary">Передать на проверку</button>
    <a href="<?=Url::toRoute('/request/close');?>">Передать на проверку</a>
<?endif;?>

<?if (\Yii::$app->user->identity->getRole() == 'admin') :?>
<a href="<?=Url::toRoute('/request/close');?>">Закрыть заявку</a>
<?endif;?>