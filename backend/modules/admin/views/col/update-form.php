<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use app\models\Marka;
use kartik\color\ColorInput;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Model */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
	$marka= empty($model->id_marka) ? '' : Marka::findOne($model->id_marka)->marka;
?>
<div class="col-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>


   		<?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'color')->widget(ColorInput::classname(),[
				//'initValueText' => $sim,
				//'data' => ArrayHelper::map(Color::find()->all(), 'name', name),
				'options' => ['placeholder' => 'Укажите цвет'],
				'pluginOptions' => [
	                 'allowClear' => true,
	            ]
		]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS

$('form#{$model->formName()}').on('beforeSubmit', function(e){
	var \$form = $(this);
	$.post(
		\$form.attr("action"),
		\$form.serialize()
	)
	.done(function(result){
		if(result == 1){
			$(document).find('#root').modal('hide');

			$.pjax.reload({container:'#model-pjax-container'});
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}
	}).fail(function(){
		console.log("server error");
	});
	return false;
})

JS;


$this->registerJs($script)
?>
