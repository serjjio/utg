<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use app\models\Fil;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Model */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
	$marka= empty($model->idFil) ? '' : Fil::findOne($model->idFil)->fil;
?>
<div class="pod-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

		<?= $form->field($model, 'idFil')->widget(Select2::classname(),[
				//'initValueText' => $sim,
				'data' => ArrayHelper::map(Fil::find()->orderBy('fil')->all(), 'idfil', 'fil'),
				'options' => ['placeholder' => 'Укажите филиал'],
				'pluginOptions' => [
	                 'allowClear' => true,
	            ]
		]) ?>


    <?= $form->field($model, 'podcol')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

