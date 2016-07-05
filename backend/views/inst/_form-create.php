<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use app\models\Auto;
use yii\widgets\Pjax;
use app\models\Unit;
use app\models\Marka;
use app\models\Model;
use app\models\Fil;
use app\models\Typets;
use app\models\Installer;
use app\models\Col;
use kartik\date\DatePicker;
use kartik\switchinput\SwitchInput;
use yii\bootstrap\Modal;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Inst */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

    Modal::begin([
                'header'=>'<h4 class="moadl-tittle">Detail Inst</h4>',
                'options' => ['tabindex' => false],
                'id' => 'blok',

            ]);
        echo "<div id='modalContent'></div>";
    Modal::end();

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-tittle">Создание новой установки</h3>
    </div>
    <div class="panel-body">
        <?php Pjax::begin(['id' => 'auto'])?>
        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]) ?>


            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h>Блок</h>
                </div>
                <div class="panel-body">
                    <div class="form-group" >
                        <?= Html::activeLabel($model, 'idAuto', ['label'=>'Выбор блока', 'class'=>'col-sm-2 control-label'])?>
                        
                        <div class="col-sm-3">
                            <?= $form->field($model, 'blok', ['showLabels' => false])->widget(Select2::classname(),[
                                'data' => ArrayHelper::map(Unit::find()->all(), 'blok', 'name_block'),
                                'options' => ['placeholder' => 'Укажите номер блока'],
                                'pluginOptions' => ['allowClear' => true]
                            ])?>
                        </div>
                        <div id="alert-hide" class="col-sm-3" style="min-width: 40%;display: none">
                        <div class="alert alert-success" role="alert">
                            <strong>Заебись!!! Можно создавать установку</strong>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>





            <!-- Insert Auto -->
            <div id="hide-auto" style="display:none">
            <div class="panel panel-info">
            <div class="panel-heading">
                            <h>Авто</h>
                        </div>
                <div class="form-group">
                                          
                    
                        
                        <div class="panel-body">
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

                                        'options' => ['placeholder' => 'Укажите модель ТС', ],
                                        'pluginOptions' => ['allowClear' => true]
                                ])?>
                            </div>
                            
                        </div>
                        <div class="panel-body" style="padding-top: 0">
                            <!-- <div class="col-sm-3">
                                <?= $form->field($modelAuto, 'V', ['showLabels' => false])->textInput(['placeholder' => 'Бортовая сеть ТС'])?>
                            </div>
 -->                            <div class="col-sm-3">
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
                                        'data' => [],
                                        'hideSearch' => true,
                                        'options' => ['placeholder' => 'Укажите подразделение'],
                                        'pluginOptions' => ['allowClear' => true]
                                ])?>
                            </div>
                            
                        </div>

                </div>     
                    
                
            </div>
            
   

            <div class="panel panel-success">
                <div class="panel-heading" style="background-color: #A9DFBF; color: #145A32">
                    <h>Здесь нужно внести информацию о монтаже</h>
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
                    <div class="col-sm-3">
                        <?= $form->field($model, 'date', ['showLabels' => false])->widget(DatePicker::classname(),[
                                'name' => 'dp_1',
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                //'value' => '28-May-1989',
                                'pluginOptions'=> [
                                    'autoclose' => true,
                                    'format' => 'dd-m-yyyy'
                                ],
                                //'options' => ['placeholder' => 'Select date...']
                        ])?>
                    </div>
                </div>


                <div class="form-group">
                    <?= Html::activeLabel($model, 'ID', ['label' => 'Информация монтажа', 'class' => 'col-sm-2 control-label'])?>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'V', ['showLabels' => false])->dropDownList([
                                //'promt' => 'Select V...',
                                '12' => '12 Вольт',
                                '24' => '24 Вольт',
                        ])?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'dut', ['showLabels' => false])->textInput(['placeholder' => 'Кол-во ДУТ'])?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'biz', ['showLabels' => false])->textInput(['placeholder' => 'Кол-во БИЗ'])?>
                    </div>
                    <div id="my-label">
                    <?= Html::activeLabel($model, 'ID', ['label' => 'Моточасы', 'class' => 'col-sm-2 control-label'])?>
                    <div class="col-sm-2 my-col">
                        <?= $form->field($model, 'moto', ['showLabels' => false])->widget(SwitchInput::classname(),[
                                'pluginOptions' => [
                                    'onText' => 'Есть',
                                    'offText' => 'Нету'
                                ],
                                //'options' => ['style' => 'padding-left:15px']
                        ])?>
                    </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-3">
                        <?= $form->field($model, 'col', ['showLabels' => false])->widget(Select2::classname(),[
                            'data' => ArrayHelper::map(Col::find()->orderBy('comment')->all(), 'id', 'comment'),
                            'options' => ['placeholder' => 'Текущий статус установки'],
                            'pluginOptions' => ['allowClear' => true]
                        ])?>
                    </div>
                    <!-- <div id="alert-col" class="col-sm-3" style="min-width: 40%;display: none">
                        <div class="" role="alert">
                            <strong id="textcomment"></strong>
                        </div>
                        </div> -->
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
                    
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary'])?>
                    <?= Html::submitButton('Обновить', ['class' => 'btn btn-default'])?>
                </div>
            </div>
            </div>
            


        <?php ActiveForm::end();  ?>
        <?php Pjax::end()?>

    </div>
</div>
<!-- <div class="col-sm-1">
                <?= Html::button('Добавить авто', ['class' => 'btn btn-success', 'id' => 'addBlok', 'value'=>'/auto/create-ajax'])?>
                </div> -->
<?php

$script = <<< JS

$('#addBlok').click(function(){
    $('#blok').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));   
})

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
$('#inst-blok').change(function(){
    var id = $(this).val();
    if(id){
        $('#alert-hide').show('slow')
        $('#hide-auto').show('slow')
    }else{
        $('#alert-hide').hide('slow')
        $('#hide-auto').hide('slow')
    }
    //
})

$("#inst-col").change(function(){
    var val = $(this).val();
    if (val == 1){
        $('#select2-inst-col-container').css("color", "orange");
        //$('#textcomment').append('Hello');
        //$('#alert-col').show('slow');
    }else if (val == 2){
        $('#select2-inst-col-container').css("color", "red");
    }else if (val == 3){
        $('#select2-inst-col-container').css("color", "green");
    }else if (val == 4){
        $('#select2-inst-col-container').css("color", "blue");
    }
})


JS;

$this->registerJs($script)

?>

