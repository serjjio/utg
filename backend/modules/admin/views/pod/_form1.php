<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'podcol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idFil')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
