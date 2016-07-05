<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Auto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gosNum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'typeTs')->textInput() ?>

    <?= $form->field($model, 'idMarka')->textInput() ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'V')->textInput() ?>

    <?= $form->field($model, 'fil')->textInput() ?>

    <?= $form->field($model, 'pod')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success ajax-modal' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
