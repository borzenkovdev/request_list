<?php
use \yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Заявка № ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Заявка №<?=$model->id;?></h1>
<p>
    <a href="<?=Url::toRoute(['index'])?>">&larr; Вернуться к списку заявок</a>
</p>
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
<?//if (Yii::$app->user->identity->getRole() == User::ROLE_ADMIN):?>
<h4>Истрия изменения статусов</h4>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'description',
        'managerFormatted',
        'created_at',
    ],
]); ?>
<?//endif;?>
//todo выголядить не оч
<p><?=$model->buttons;?></p>