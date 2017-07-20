<?php
/* @var $this yii\web\View */
use app\models\Request;
use \yii\helpers\Url;

$this->title = 'Заявка № ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <a href="<?=Url::toRoute(['index'])?>">&larr; Вернуться к списку заявок</a>
</p>
<div class="col-6">
    <h1>Заявка №<?=$model->id;?></h1>

    <?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
        <?php foreach($messages as $message): ?>
            <?php foreach($message as $mes): ?>
                <?php foreach($mes as $err): ?>
                    <div class="alert alert-warning" role="alert"><?=$err?></div>
                <?php endforeach ?>
            <?php endforeach ?>
        <?php endforeach ?>
    <?php endforeach ?>

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
    </form>

</div>



