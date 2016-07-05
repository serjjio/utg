<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use app\models\Marka;
use app\models\Model;
use app\models\Typets;
use app\models\Fil;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Model */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
	$model_marka= empty($model->id_model) ? '' : model::findOne($model->id_model)->name_model;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-tittle"><?= $modelUnit->isNewRecord ? 'Добавление блока' : 'Редактирование'?></h3>
    </div>
    <div class="panel-body">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL]); ?>

		
                
                                          
                    
                        
               
                        <div class="form-group">
                        	<?= Html::activeLabel($model, 'gosNum', ['label' => 'Гос номер', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'gosNum', ['showLabels' => false])->textInput(['placeholder' => 'Гос Номер'])?>
                            </div>
                            <?= Html::activeLabel($model, 'typeTs', ['label' => 'Тип ТС', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-3">

                                <?= $form->field($model, 'typeTs', ['showLabels' => false])->widget(Select2::classname(),[
                                    'data' => ArrayHelper::map(Typets::find()->all(), 'id', 'typeTs'),
                                    'options' => ['placeholder' => 'Укажите Тип ТС'],
                                    'pluginOptions' => ['allowClear' => true]
                                ])?>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <?= Html::activeLabel($model, 'idMarka', ['label' => 'Марка', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'idMarka', ['showLabels' => false])->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(Marka::find()->all(), 'Id', 'marka'),
                                        'options' => ['placeholder' => 'Укажите марку ТС'],
                                        'pluginOptions' => ['allowClear' => true]
                                ])?>
                            </div>
                            <?= Html::activeLabel($model, 'id_model', ['label' => 'Модель', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'id_model', ['showLabels' => false])->widget(Select2::classname(), [
                                        'initValueText' => $model_marka,
                                        'options' => ['placeholder' => 'Укажите модель ТС', ],
                                        'pluginOptions' => ['allowClear' => true]
                                ])?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'inv', ['label' => 'Инвентарный номер', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'inv', ['showLabels' => false])->textInput(['placeholder' => 'Инвентарный номер'])?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'comment', ['label' => 'Комментарий', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-10">
                                <?= $form->field($model, 'comment', ['showLabels' => false])->textArea([
                                    'placeholder' => 'Сюда можно что-то написать',
                                    'rows' => 4,
                                ])?>
                            </div>
                        </div>



    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">

            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
                            
                        
                        
   
                    
                
          

    <?php ActiveForm::end(); ?>

</div>
</div>



<?php

$script = <<<JS

function funcSuccess(data){
    $('#auto-id_model').html(data);
    $('#auto-id_model').select2("val")
}

$('#auto-idmarka').change(function(){
    var id = $(this).val();
    $.ajax({
        url: "/inst/change-marka/",
        type: "GET",
        data: ({id : id}),
        success: funcSuccess
    })
})

JS;



$this->registerJS($script)
?>