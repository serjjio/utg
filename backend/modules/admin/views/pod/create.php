<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pod */

?>
<div class="pod-create">

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
			//$(document).find('#marka').modal('hide');
			if ($(document).find('#alert-message').addClass('alert alert-success').css('display', 'block').html('Модель создана! Можете добавить еще модель, либо закройте окно!')){
				$('#pod-podcol').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-success');
					$('#pod-podcol').val('');
				})
			}

			$.pjax.reload({container:'#model-pjax-container'})
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}else if(result == 3){
			if ($(document).find('#alert-message').addClass('alert alert-danger').css('display', 'block').html('Модель с таким именем уже существует! Проверьте правильность написания!')){
				$('#pod-podcol').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-danger');
					$('#pod-podcol').val('');
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
