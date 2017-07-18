<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Список заявок';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Список заявок</h1>

<p>
    <?= Html::a('Новая заявка', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'statusformatted',
        'workManager' => [
            'attribute' => 'Исполнитель',
            'header' => 'Исполнитель',
            'contentOptions' => [
                'style' => 'vertical-align: top'
            ],
            'content' => function($data) {
                return $data->workManager->login;
            }
        ],
        'creator' => [
            'attribute' => 'Заявка создана',
            'header' => 'Заявка создана',
            'contentOptions' => [
                'style' => 'vertical-align: top'
            ],
            'content' => function($data) {
                return $data->creator->login;
            }
        ],
        'created_at',
//        'actions' => [
//            'attribute' => '',
//            'header' => '',
//            'contentOptions' => [
//                'style' => 'vertical-align: top'
//            ],
//            'content' => function($data) {
//                return $data->creator->login;
//
//            }
//        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>