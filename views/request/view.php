<?php
use \yii\helpers\Url;
use yii\grid\GridView;
use app\models\User;

$this->title = 'Заявка № ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <a href="<?=Url::toRoute(['index'])?>">&larr; Вернуться к списку заявок</a>
</p>

<h1>Заявка №<?=$model->id;?></h1>
<h4>Название</h4>
<p><?=$model->name;?></p>
<h4>Создатель</h4>
<p><?=$model->creatorFormatted;?></p>
<h4>Дата создания</h4>
<p><?=$model->created_at;?></p>
<h4>Cтатус</h4>
<p><?=$model->statusformatted;?></p>
<h4>Описание</h4>
<p><?=$model->description;?></p>

<?if (Yii::$app->user->identity->getRole() == User::ROLE_ADMIN):?>
<div>
    <h4>История изменения статусов</h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'description',
            'managerFormatted',
            'created_at',
        ],
    ]); ?>
</div>
<?endif;?>
<p><?=$model->buttonsDetail;?></p>