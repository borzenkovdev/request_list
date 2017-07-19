<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Список заявок';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>История изменения заявки</h1>

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
    ],
]); ?>