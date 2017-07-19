<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

$this->title = 'Список заявок';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Список заявок</h1>

<p>
    <?= Html::a('Новая заявка', ['create'], ['class' => 'btn btn-success']) ?>
</p>
    <?= Html::a('Мои незавершенные заявки', ['', 'show'=>'unfinished'], ['class' => 'link']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
//    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'name' => [
            'attribute' => 'Название',
            'header' => 'Название',
            'content' => function($data) {
                return  '<a href="' . Url::toRoute(['view', 'id' => $data->id]). '">'.$data->name.'</a>';
            }
        ],
        'workManager' => [
            'attribute' => 'Исполнитель',
            'header' => 'Исполнитель',
            'contentOptions' => [
                'style' => 'vertical-align: top'
            ],
            'content' => function($data) {
                return $data->workManagerFormatted;
            }
        ],
        'creator' => [
            'attribute' => 'Заявка создана',
            'header' => 'Заявка создана',
            'contentOptions' => [
                'style' => 'vertical-align: top'
            ],
            'content' => function($data) {
                return $data->creatorFormatted;
            }
        ],
        'created_at',
        'statusformatted',
        'actions' => [
            'contentOptions' => [
                'style' => 'text-align: center'
            ],
            'attribute' => '',
            'header' => '',
            'content' => function($data) {
                return $data->buttons;
            }
        ]
    ],
]); ?>