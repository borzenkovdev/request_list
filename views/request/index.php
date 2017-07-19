<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

$this->title = 'Список заявок';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
    <?php foreach($messages as $message): ?>
        <div class="alert alert-<?= $type ?>" role="alert"><?= $message ?></div>
    <?php endforeach ?>
<?php endforeach ?>

<h1>Список заявок</h1>
<p>
    <?= Html::a('Новая заявка', ['create'], ['class' => 'btn btn-success']) ?>
    <?if($_GET['show'] !== 'unfinished'):?>
        <?= Html::a('Мои незавершенные заявки', ['', 'show'=>'unfinished'], ['class' => 'link', 'style' => 'margin-left: 15px;']) ?>
    <?else:?>
        <?= Html::a('Все заявки', ['index'], ['class' => 'link', 'style' => 'margin-left: 15px;']) ?>
    <?endif;?>
</p>

<div id="search_block" class="panel-body">
    <form role="form" class="form-horizontal" method="get" action="">
        <div class="form-group">
            <label class="col-md-1 control-label" for="v_name">Название:</label>
            <div class="col-md-3">
                <input type="text" placeholder="Введите название заявки" value="<?=$_GET['name'];?>" name="name" id="v_search" class="form-control">
            </div>
             <label class="col-md-1 control-label" for="v_creator">Создатель:</label>
            <div class="col-md-3">
                <input type="text" placeholder="Создатель заявки" value="<?=$_GET['creator'];?>" name="creator" id="v_creator" class="form-control">
            </div>
            <label class="col-md-1 control-label" for="v_manager">Исполнитель:</label>
            <div class="col-md-3">
                <input type="text" placeholder="Исполнитель заявки" value="<?=$_GET['manager'];?>" name="manager" id="v_manager" class="form-control">
            </div>
      </div>
      <div class="form-group">
            <label class="col-md-1 control-label" for="v_status">Статус:</label>
            <div class="col-md-3">
               <select id="v_status" value="<?=$_GET['status'];?>" class="form-control" name="status">
                    <option <?if($_GET['status'] == "new"):?> selected <?endif;?> value="new">Новая</option>
                    <option <?if($_GET['status'] == "inwork"):?> selected <?endif;?> value="inwork">В работе</option>
                    <option <?if($_GET['status'] == "inreview"):?> selected <?endif;?> value="inreview">На проверке</option>
                    <option <?if($_GET['status'] == "closed"):?> selected <?endif;?>  value="closed">Закрыта</option>
                </select>
            </div>
            <label class="col-md-1 control-label" for="v_date">Дата:</label>
            <div class="col-md-2">
                <input type="text" placeholder="Дата создания" value="<?=$_GET['date'];?>" name="date" id="v_date" class="form-control">
            </div>
        </div>
        <div class="button-group col-xs-10 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-3 col-md-offset-0">
            <button class="btn btn-primary" value="search" name="search" type="submit">Найти</button>
            <a href="<?=Url::toRoute(['index']);?>" class="btn btn-default">сбросить фильтр</a>
        </div>
    </form>
</div>

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
                return $data->buttonsTable;
            }
        ]
    ],
]); ?>