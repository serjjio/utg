<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inst */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inst-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'point')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idAuto')->textInput() ?>

    <?= $form->field($model, 'blok')->textInput() ?>

    <?= $form->field($model, 'idInstaller')->textInput() ?>

    <?= $form->field($model, 'V')->textInput() ?>

    <?= $form->field($model, 'dut')->textInput() ?>

    <?= $form->field($model, 'biz')->textInput() ?>

    <?= $form->field($model, 'moto')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'col')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
