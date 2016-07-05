<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InstSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inst-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'point') ?>

    <?= $form->field($model, 'idAuto') ?>

    <?= $form->field($model, 'blok') ?>

    <?php // echo $form->field($model, 'idInstaller') ?>

    <?php // echo $form->field($model, 'V') ?>

    <?php // echo $form->field($model, 'dut') ?>

    <?php // echo $form->field($model, 'biz') ?>

    <?php // echo $form->field($model, 'moto') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'col') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
