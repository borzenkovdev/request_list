<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Создать новую заявку';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Новая заявка</h1>

<?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
    <?php foreach($messages as $message): ?>
        <?php foreach($message as $mes): ?>
            <?php foreach($mes as $err): ?>
                <div class="alert alert-warning" role="alert"><?=$err?></div>
            <?php endforeach ?>
        <?php endforeach ?>
    <?php endforeach ?>
<?php endforeach ?>

<form method="post">
    <div class="form-group">
        <label for="request_name">Название</label>
        <input type="text" name="Request[name]" class="form-control" id="request_name" placeholder="Тема заявки">
    </div>
    <div class="form-group">
        <label for="request_descr">Описание</label>
        <textarea class="form-control" id="request_descr" rows="3"  name="Request[description]" ></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>