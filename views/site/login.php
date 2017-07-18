<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

 <?php $form = ActiveForm::begin([
     'class' => 'form-signin',
 ]); ?>
<h2 class="form-signin-heading">Авторизация</h2>
 <?= $form->field($model, 'username') ?>

 <?= $form->field($model, 'password')->passwordInput() ?>

 <?= $form->field($model, 'rememberMe')->checkbox() ?>

 <div class="form-group text-right">
     <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
 </div>

 <?php ActiveForm::end(); ?>