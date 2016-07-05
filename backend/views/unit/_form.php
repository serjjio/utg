<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use app\models\Unit;
use app\models\Sim;
use yii\web\JsExpression;









/* @var $this yii\web\View */
/* @var $model app\models\Inst */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
	$sim = empty($modelUnit->idSim) ? '' : Sim::findOne($modelUnit->idSim)->SIM;
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-tittle"><?= $modelUnit->isNewRecord ? 'Добавление блока' : 'Редактирование'?></h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]) ?>


            
                
                
                    <div class="form-group" >
                        
                        <?= Html::activeLabel($modelUnit, 'name_block', ['label' => 'Номер блока', 'class' => 'col-sm-2 control-label'])?>
                        <div class="col-sm-3">
                            <?= $form->field($modelUnit, 'name_block', ['showLabels' => false])->textInput(['placeholder' => 'Номер блока'])?>
                        </div>
                        <?= Html::activeLabel($modelUnit, 'IMEI', ['label' => 'IMEI', 'class' => 'col-sm-2 control-label'])?>
                        <div class="col-sm-3">
                            <?= $form->field($modelUnit, 'IMEI', ['showLabels' => false])->textInput(['placeholder' => 'IMEI'])?>
                        </div>
                    </div>
                    <div class="form-group" >
                    	<?= Html::activeLabel($modelUnit, 'idConfig', ['label' => 'Конфигурация', 'class' => 'col-sm-2 control-label'])?>
                        <div class="col-sm-3">
                            <?= $form->field($modelUnit, 'idConfig', ['showLabels' => false])->textInput(['placeholder' => 'Config'])?>
                        </div>
                        <?= Html::activeLabel($modelUnit, 'idFw', ['label' => 'Прошивка', 'class' => 'col-sm-2 control-label'])?>
                        <div class="col-sm-3">
                            <?= $form->field($modelUnit, 'idFw', ['showLabels' => false])->textInput(['placeholder' => 'Firmware'])?>
                        </div>
 
                    </div>
                    <div class="form-group">
                        
                        <?= Html::activeLabel($modelUnit, 'idSim', ['label' => 'Номер SIM', 'class' => 'col-sm-2 control-label'])?>
                        
                        <div class="col-sm-3">
                            <?= $form->field($modelUnit, 'idSim', ['showLabels' => false])->widget(Select2::classname(), [
                            		'initValueText' => $sim,
                            		//'language' => 'ru',
                            		'options' => ['placeholder' => 'Укажите SIM'],
                            		'pluginOptions' => [
                            			'allowClear' => true,
                            			'minimumInputLength' => 3,
                            			'language' => [
                            				'errorLoading' => new JsExpression("function () {return 'Ожидание...'}"),
                            				'inputTooShort' => new JsExpression("function () {return 'Введите больше 3 символов'}"),
                            				'noResults' => new JsExpression("function () {return 'Совпадений не найдено'}"),
                            			],
                            			'ajax' => [
                            				'url' => '/unit/sim-list',
                            				'dataType' => 'json',
                            				'data' => new JsExpression("function (params) {return {q:params.term};}"),
                            			],
                            			'escapeMarkup' => new JsExpression("function (markup) {return markup;}"),
                            			'templateResult' => new JsExpression("function (idSim) {return idSim.text;}"),
                            			'templateSelection' => new JsExpression("function (idSim) {return idSim.text;}"),
                            		]
                            ])?>
                        </div>
                        
                        <div class="col-sm-5" id="add-sim">
                        <?= Html::button('Добавить СИМ-карту', ['class'=>'btn btn-success', 'value'=>'yii2-app-advanced/backend/web/', 'id'=>'create-panel-for-sim'])?>
                        
                        </div>
                        <div id="icc" style="display: none">
                        	<?= Html::activeLabel($modelUnit, 'idICC', ['label' => 'ICC', 'class' => 'col-sm-2 control-label'])?>
	                        <div class="col-sm-3">
	                            <?= Html::activeLabel($modelUnit, 'idICC', ['label' => 'ICC', 'class' => 'col-sm-2 control-label', 'id'=> 'icc-add'])?>
	                        </div>
                        </div>

 
                    </div>
                    <div class="form-group">
                    	
		                <div class="col-sm-offset-2 col-sm-10">
			                <div class="panel panel-primary" id="panel-hide" style="display: none">
			                <button type="button" class="close" aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></button>
				                <div class="panel-heading">
				                	<h>Добавление СИМ-карты</h>
				                </div>
				                <div class="panel-body">
				                	<div id="loader" style="display:none;">
	                    				<img src="/images/gif.gif">
	                    			</div>
	                    			<div id="panel-input">
									<div class="col-sm-4">
				                        <input id="number-sim" type="text" class="form-control" placeholder="SIM"></input>
				                    	<div class="help-block" id="error-sim" style="color: #a94442; display: none"> введите номер</div>
				                    </div>

				                    <div class="col-sm-5">
				                        <input id="number-icc" type="text" class="form-control" placeholder="ICC"></input>
				                        <div class="help-block" id="error-icc" style="color: #a94442; display: none"> введите icc</div>
				                    </div>

				                    <div class="col-sm-2">

				                        <?= Html::button('Добавить', ['class' => 'btn btn-success', 'id'=>'create-sim'])?>
				                    </div>
				                    </div>

				                </div>
			                </div>
	                    		
	                	</div>
	                	
	                	
	            	</div>
                
            
            <!-- <div class="panel panel-info">
                <div class="panel-heading">
                    <h>Блок</h>
                </div>
                <div class="panel-body">
                    
                </div>
            </div> -->


            <div class="form-group" >
                        
                        <?= Html::activeLabel($modelUnit, 'comment', ['label' => 'Комментарий', 'class' => 'col-sm-2 control-label'])?>
                        <div class="col-sm-6">
                            <?= $form->field($modelUnit, 'comment', ['showLabels' => false])->textArea(['placeholder' => 'Пишите...', 'rows' => 4])?>
                        </div>
                        
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    
                    <?= Html::submitButton($modelUnit->isNewRecord ? 'Создать' : 'Обновить', ['class' => 'btn btn-primary'])?>
                    <!-- <?= Html::submitButton('Обновить', ['class' => 'btn btn-default'])?> -->
                </div>
            </div>
            
            


        <?php ActiveForm::end();  ?>

    </div>
</div>

<?php

$script = <<<JS

$('#unit-idsim').change(function(){
	var id = $(this).val();
	$.ajax({
		url : "/unit/get-icc",
		type : "GET",
		data : {id : id},
		success : function(data){
			if(id){
				$('#icc-add').css("color", "green")
							.html(data)
				$('#add-sim').hide();
				$('#panel-hide').hide();
				$('#icc').show()
			}else{
				$('#icc').hide('slow')
				$('#add-sim').show('slow')
			}
		}
	})
})

$('#create-panel-for-sim').click(function(){
	$('#panel-hide').show('slow');
	$('#add-sim').hide()
})

$('#create-sim').click(function(){
	var sim = $('#number-sim').val();
	var icc = $('#number-icc').val();
	if(sim =='' || icc==''){
		if(sim == ''){
			$('#error-sim').show();
			$('#error-icc').hide();
			return false;
		}else{
			$('#error-icc').show()
			$('#error-sim').hide();
			return false;
		}
	}else{
		$('#error-icc').hide();
		$('#error-sim').hide();
		$.ajax({
			url: '/unit/add-sim',
			type: "POST",
			data : {sim : sim, icc : icc},
			beforeSend: function(){
				$('#panel-input').hide();
				$('#loader').css("display", "block");
				$('#loader').animate({opacity:1}, 500);

			},
			success: function(data){
				if(data == 1){
					//$.pjax.reload({container:'#sim-sim'});
					$('#panel-input').find('input').val('');
					$('#loader').animate({opacity:0}, 500);
					$('#loader').css("display", "none");
					$('#panel-input').show('slow');
				}
				
			}


		});
		return false;	
	}
	
})

$('.close').click(function(){
	$('#panel-hide').hide('slow');
	$('#add-sim').show('slow')

})

JS;

$this->registerJs($script);


?>




