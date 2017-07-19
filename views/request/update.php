<?php

/* @var $this yii\web\View */
use \yii\helpers\Url;
use app\models\Request;
//use kartik\date\DatePicker;

$this->title = 'Заявка № ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Заявка №<?=$model->id;?></h1>
    <div class="form-group">
        <label>Дата создания</label>
        <div><?=$model->created_at;?></div>
    </div>
    <div class="form-group">
        <label>Статус</label>
        <div><?=$model->statusformatted;?></div>
    </div>
<form method="post">
    <div class="form-group">
        <label for="request_name">Название</label>
        <input type="text" name="Request[name]" class="form-control" id="request_name" placeholder="Тема заявки" value="<?=$model->name;?>">
    </div>
    <div class="form-group">
        <label for="request_descr">Описание</label>
        <textarea class="form-control" id="request_descr" rows="3"  name="Request[description]" ><?=$model->description;?></textarea>
    </div>
    <?if ($model->status == Request::STATUS_INREVIEW):?>
        <div class="form-group">
            <label for="request_res">Резузльтат работы по заявке</label>
            <textarea class="form-control" id="request_res" rows="3"  name="Request[result]" ><?=$model->result;?></textarea>
        </div>
    <?endif;?>
    <button type="submit" class="btn btn-primary">Обновить</button>
    <?if ($model->created_by == \Yii::$app->user->identity->getId() && $model->status == Request::STATUS_INWORK) :?>
        <a href="<?=Url::toRoute(['/request/sendtoreview', 'id' => $model->id]);?>">Передать на проверку</a>
    <?endif;?>
    <?if (\Yii::$app->user->identity->getRole() == 'admin' && $model->status == Request::STATUS_INREVIEW) :?>
        <a href="<?=Url::toRoute(['/request/close', 'id' => $model->id]);?>">Закрыть заявку</a>
    <?endif;?>
</form>



