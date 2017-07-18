<?php

/* @var $this yii\web\View */

$this->title = 'Заявка № ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Заявка №<?=$model->id;?></h1>

<h4>Название</h4>
<p><?=$model->name;?></p>
<h4>Создатель</h4>
<p><?=$model->creator->login;?></p>
<h4>Дата создания</h4>
<p><?=$model->created_at;?></p>
<h4>Cтатус</h4>
<p><?=$model->statusformatted;?></p>
<h4>Описание</h4>
<p><?=$model->description;?></p>
