<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Test task',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $user_items = [];
    $user_items[] = ['label' => 'Заявки в работе', 'url' => '/request/inwork'];
    $user_items[] = '<li class="divider"></li>';
    $user_items[] = ['label' => 'Выход', 'url' => '/site/logout', 'linkOptions' => ['data-method' => 'post']];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => Yii::$app->user->isGuest ? [['label' => 'Вход', 'url' => ['/site/login']]] : [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Список заявок', 'url' => ['/request/index']],
            [
                'label' => Yii::$app->user->identity->login,
                'items' => $user_items,
            ]
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Borzenkov Ivan <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
