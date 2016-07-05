<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AutoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTs') ?>

    <?= $form->field($model, 'gosNum') ?>

    <?= $form->field($model, 'typeTs') ?>

    <?= $form->field($model, 'idMarka') ?>

    <?= $form->field($model, 'model') ?>

    <?php echo $form->field($model, 'V') ?>

    <?php echo $form->field($model, 'fil') ?>

    <?php echo $form->field($model, 'pod') ?>

    <?php  echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
