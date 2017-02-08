<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-content">
    <div class="row">
        <form>
            <div class="col-lg-12">
                <div class="input-group col-md-12">
                    <input name="query" value="<?= $_SESSION['stackoverflow_query']; ?>" type="text" class=" search-query form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                </div>
            </div>
        </form>
    </div>
    <!-- /.row -->

    <div class="questions-list">
        <h3><?=$findedQestitonsQuantity;?> results</h3>
<!--        --><?// Pjax::begin(['id' => 'countries']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{pager}",
            'columns' => [
                [
                    'label' => '',
                    'attribute' => '',
                    'value' => function ($data) {
                        return
                            '<table class="table table-responsive table-min">
                               <tr>
                                 <th>' . $data['score'] . '</th>
                                 <th>' . $data['answer_count'] . '</th>
                                 <th>' . $data['view_count'] . '</th>
                               </tr>
                                <tr>
                                   <td>votes</td>
                                   <td>answers</td>
                                   <td>view</td>
                                </tr>
                             </table>';
                    },
                    'format' => 'raw'
                ],
                [
                    'label' => 'creation date',
                    'attribute' => 'creation_date',
                    'value' => function ($data) {
                        return date('d.m.Y', $data['creation_date']);
                    },
                    'class' => 'yii\grid\DataColumn',
                ],
                [
                    'label' => 'question title',
                    'attribute' => 'question_title',
                    'value' => function ($data) {
                        return Html::a($data['title'], $data['link'], ['target' => '_blank']);
                    },
                    'format' => 'raw'
                ],
                [
                    'label' => 'owner',
                    'attribute' => 'attribute',
                    'value' => function ($data) {
                        return Html::a($data['owner']['display_name'], $data['owner']['link'], ['target' => '_blank']);
                    },
                    'format' => 'raw'
                ]
            ],
            'rowOptions' => function ($data) {
                if ($data['is_answered']) {
                    return ['class' => 'answered'];
                }
            }
        ]);
        ?>
<!--        --><?// Pjax::end(); ?>
    </div>
</div>
