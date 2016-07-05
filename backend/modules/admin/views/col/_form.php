<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use kartik\color\ColorInput;
use app\models\Marka;
use app\models\Color;
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
				'size' => 'lg',
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
			//$(document).find('#marka').modal('hide');
			if ($(document).find('#alert-message').addClass('alert alert-success').css('display', 'block').html('Статус создан! Можете добавить еще статус, либо закройте окно!')){
				$('#col-comment').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-success');
					$('#col-comment').val('');
				})
			}

			$.pjax.reload({container:'#model-pjax-container'})
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}else if(result == 3){
			if ($(document).find('#alert-message').addClass('alert alert-danger').css('display', 'block').html('Статус с таким именем уже существует! Проверьте правильность написания!')){
				$('#col-comment').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-danger');
					$('#col-comment').val('');
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
