<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use app\models\Marka;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Model */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
	$marka= empty($model->id_marka) ? '' : Marka::findOne($model->id_marka)->marka;
?>
<div class="model-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

		<?= $form->field($model, 'id_marka')->widget(Select2::classname(),[
				//'initValueText' => $sim,
				'data' => ArrayHelper::map(Marka::find()->orderBy('marka')->all(), 'Id', 'marka'),
				'options' => ['placeholder' => 'Укажите марку'],
				'pluginOptions' => [
	                 'allowClear' => true,
	            ]
		]) ?>


    <?= $form->field($model, 'name_model')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

