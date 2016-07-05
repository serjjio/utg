<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Marka */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marka-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'marka')->textInput(['maxlength' => true]) ?>

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
			//$(document).find('#marka').modal('hide');
			if ($(document).find('#alert-message').addClass('alert alert-success').css('display', 'block').html('Марка создана! Можете создать еще марку, либо закройте окно!')){
				$('#marka-marka').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-success');
					$('#marka-marka').val('');
				})
			}

			$.pjax.reload({container:'#model-pjax-container'})
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}else if(result == 3){
			if ($(document).find('#alert-message').addClass('alert alert-danger').css('display', 'block').html('Марка с таким именем уже существует! Проверьте правильность написания!')){
				$('#marka-marka').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-danger');
					$('#marka-marka').val('');
				})
			}
		}
	}).fail(function(){
		console.log("server error");
	});
	return false;
})

JS;


$this->registerJs($script)
?>