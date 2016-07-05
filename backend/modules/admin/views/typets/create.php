<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Typets */

?>
<div class="typets-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

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
			if ($(document).find('#alert-message').addClass('alert alert-success').css('display', 'block').html('Тип ТС создан! Можете создать еще тип ТС, либо закройте окно!')){
				$('#typets-typets').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-success');
					$('#typets-typets').val('');
				})
			}

			$.pjax.reload({container:'#model-pjax-container'})
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}else if(result == 3){
			if ($(document).find('#alert-message').addClass('alert alert-danger').css('display', 'block').html('тип ТС с таким именем уже существует! Проверьте правильность написания!')){
				$('#typets-typets').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-danger');
					$('#typets-typets').val('');
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
