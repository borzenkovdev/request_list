<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Передать на проверку';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Закрыть заявку</h1>

<form method="post">
    <div class="form-group">
        <label for="request_descr">Опишите результат работы по заявке</label>
        <textarea class="form-control" id="request_descr" rows="3"  name="Request[result]" ></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Передать на проверку</button>
</form>