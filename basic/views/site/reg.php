<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-reg">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'login') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Registration', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <?php
    if($model->scenario === 'emailActivation'):
    ?>
    <i>*A valid email will be sent an email to activate your account.</i>
    <?php
    endif;
    ?>

</div><!-- main-reg -->
