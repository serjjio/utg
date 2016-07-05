<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use app\models\Auto;
use app\models\Unit;
use app\models\Marka;
use app\models\Pod;
use app\models\Model;
use app\models\Fil;
use app\models\Typets;
use app\models\Installer;
use app\models\Col;
use kartik\date\DatePicker;
use kartik\switchinput\SwitchInput;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model app\models\Inst */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
?>
<div class="panel panel-default">
    <!-- <div class="panel-heading">
        <h3 class="panel-tittle">Редактирование</h3>
    </div> -->
    <div class="panel-body">

        <?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]) ?>






            <!-- Update Auto -->
           
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h>Авто</h>
                    </div>
                    <div class="panel-body">
                    
                            <div class="form-group" >
   
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'blok', ['showLabels' => false])->widget(Select2::classname(),[
                                            'data' => ArrayHelper::map(Unit::find()->all(), 'blok', 'name_block'),
                                         'options' => ['placeholder' => 'Укажите номер блока'],
                                        'pluginOptions' => ['allowClear' => true]
                                    ])?>
                                </div>
                            </div>                  
                        
                            <div class="form-group">
                            
                                <div class="col-sm-3">
                                    <?= $form->field($modelAuto, 'gosNum', ['showLabels' => false])->textInput(['placeholder' => 'Гос Номер'])?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelAuto, 'typeTs', ['showLabels' => false])->widget(Select2::classname(),[
                                        'data' => ArrayHelper::map(Typets::find()->all(), 'id', 'typeTs'),
                                        'options' => ['placeholder' => 'Укажите Тип ТС'],
                                        'pluginOptions' => ['allowClear' => true]
                                    ])?>
                                </div>

                                <div class="col-sm-3">
                                    <?= $form->field($modelAuto, 'idMarka', ['showLabels' => false])->widget(Select2::classname(), [
                                            'data' => ArrayHelper::map(Marka::find()->all(), 'Id', 'marka'),
                                            'options' => ['placeholder' => 'Укажите марку ТС'],
                                            'pluginOptions' => ['allowClear' => true]
                                    ])?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelAuto, 'id_model', ['showLabels' => false])->widget(Select2::classname(), [
                                            'initValueText' => Model::findOne($modelAuto->id_model)->name_model,
                                            'data' => ArrayHelper::map(Model::find()->where(['id_marka' => $modelAuto->idMarka])->all(), 'idmodel', 'name_model'),
                                            'options' => ['placeholder' => 'Укажите модель ТС', ],
                                            'pluginOptions' => ['allowClear' => true]
                                    ])?>
                                </div>
                                
                            </div>
                            <div class="form-group">

                               <div class="col-sm-3">
                                    <?= $form->field($modelAuto, 'V', ['showLabels' => false])->dropDownList([
                                            //'promt' => 'Select V...',
                                            '12' => '12 Вольт',
                                            '24' => '24 Вольт',
                                    ])?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelAuto, 'inv', ['showLabels' => false])->textInput(['placeholder' => 'Инвентарный номер'])?>
                                </div>

                                <div class="col-sm-3">
                                    <?= $form->field($modelAuto, 'fil', ['showLabels' => false])->widget(Select2::classname(), [
                                            'data' => ArrayHelper::map(Fil::find()->all(), 'idfil', 'fil'),
                                            'options' => ['placeholder' => 'Укажите филиал'],
                                            'pluginOptions' => ['allowClear' => true]
                                    ])?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelAuto, 'pod', ['showLabels' => false])->widget(Select2::classname(), [
                                            'initValueText' => Pod::findOne($modelAuto->pod)->podcol,
                                            'data' => ArrayHelper::map(Pod::find()->where(['idFil' => $modelAuto->fil])->all(), 'idpod', 'podcol'),
                                            //'hideSearch' => true,
                                            'options' => ['placeholder' => 'Укажите подразделение'],
                                            'pluginOptions' => ['allowClear' => true]
                                    ])?>
                                </div>
                                
                            </div>

                    </div>     
                        
                    
                </div>
            
   

                <div class="panel panel-success">
                    <div class="panel-heading" style="background-color: #A9DFBF; color: #145A32">
                        <h>Информация о монтаже</h>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <?= Html::activeLabel($model, 'ID', ['label' => 'Локация монтажа', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'point', ['showLabels' => false])->textInput(['placeholder' => 'Город'])?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'idInstaller', ['showLabels' => false])->widget(Select2::classname(),[
                                    'data' => ArrayHelper::map(Installer::find()->orderBy('integrator')->all(), 'id', 'integrator'),
                                    'options' => ['placeholder' => 'Укажите монтажника'],
                                    'pluginOptions' => ['allowClear' => true]
                                ])?>
                            </div>
                            <div class="col-sm-3" style="width: 27%">
                                <?= $form->field($model, 'date', ['showLabels' => false])->widget(DatePicker::classname(),[
                                        'name' => 'dp_1',
                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                        //'value' => '28-May-1989',
                                        'pluginOptions'=> [
                                            'autoclose' => true,
                                            'format' => 'd-m-yyyy'
                                        ],
                                        //'options' => ['placeholder' => 'Select date...']
                                ])?>
                            </div>
                        </div>


                        <div class="form-group">
                            <?= Html::activeLabel($model, 'ID', ['label' => 'Информация монтажа', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'V', ['showLabels' => false])->dropDownList([
                                        //'promt' => 'Select V...',
                                        '12' => '12 Вольт',
                                        '24' => '24 Вольт',
                                ])?>
                            </div>
                            <?= Html::activeLabel($model, 'dut', ['label' => 'ДУТ', 'class' => 'col-sm-1 control-label'])?>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'dut', ['showLabels' => false])->textInput(['placeholder' => 'Кол-во ДУТ'])?>
                            </div>
                            <?= Html::activeLabel($model, 'biz', ['label' => 'БИЗ', 'class' => 'col-sm-1 control-label'])?>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'biz', ['showLabels' => false])->textInput(['placeholder' => 'Кол-во БИЗ'])?>
                            </div>
                            
                        </div>

                        <div class="form-group">


                            <?= Html::activeLabel($model, 'ID', ['label' => 'Статус установки', 'class' => 'col-sm-2 control-label'])?>
                             <div class="col-sm-3">
                                <?= $form->field($model, 'col', ['showLabels' => false])->widget(Select2::classname(),[
                                    'data' => ArrayHelper::map(Col::find()->orderBy('comment')->all(), 'id', 'comment'),
                                    'options' => ['placeholder' => 'Текущий статус установки'],
                                    'pluginOptions' => ['allowClear' => true]
                                ])?>
                            </div>
                            <?= Html::activeLabel($model, 'moto', ['label' => 'Моточасы', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'moto', ['showLabels' => false])->widget(CheckboxX::classname(), [
                                       'pluginOptions' => [
                                        'threeState' => false,
                                       ] 
                                ])?>
                            </div>

                            
                                

                            
                        </div>

                         <div class="form-group">
                            <?= Html::activeLabel($model, 'ID', ['label' => 'Комментарий', 'class' => 'col-sm-2 control-label'])?>
                            <div class="col-sm-10">
                                <?= $form->field($model, 'comment', ['showLabels' => false])->textArea([
                                    'placeholder' => 'Сюда можно что-то написать',
                                    'rows' => 4,
                                ])?>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    
                    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
            
            


        <?php ActiveForm::end();  ?>


    </div>
</div>

<?php

$script = <<< JS


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

$('#auto-fil').change(function(){
    var id = $(this).val()
    $.get("/inst/change-fil", {id : id}, function(result){
        $('#auto-pod').html(result);
        $('#auto-pod').select2("val")
    })
})

$('form#{$model->formName()}').on('beforeSubmit', function(e){
    var \$form = $(this);
    $.post(
        \$form.attr("action"),
        \$form.serialize()
    )
    .done(function(result){
        if(result == 1){
            $(document).find('#root').modal('hide');

            $.pjax.reload({container:'#kv-pjax-container'});
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

