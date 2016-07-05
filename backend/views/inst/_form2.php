<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use app\models\Auto;
use yii\widgets\Pjax;
use app\models\Unit;
use app\models\Installer;
use app\models\Col;
use kartik\date\DatePicker;
use kartik\switchinput\SwitchInput;
use yii\bootstrap\Modal;

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
        <h3 class="panel-tittle">Create Inst</h3>
    </div>
    <div class="panel-body">
        <?php Pjax::begin(['id' => 'auto'])?>
        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]) ?>

            <div class="form-group">
                <?= Html::activeLabel($model, 'idAuto', ['label'=>'Номер блока', 'class'=>'col-sm-2 control-label'])?>
                
                <div class="col-sm-3">
                    <?= $form->field($model, 'blok', ['showLabels' => false])->widget(Select2::classname(),[
                        'data' => ArrayHelper::map(Unit::find()->all(), 'blok', 'blok'),
                        'options' => ['placeholder' => 'Select blok'],
                        'pluginOptions' => ['allowClear' => true]
                    ])?>
                </div>
                
                
            </div>
            <div class="form-group">
            <?= Html::activeLabel($model, 'idAuto', ['label'=>'Данные автомобиля', 'class'=>'col-sm-2 control-label'])?>

                <!-- <div class="col-sm-3">
                
                    <?= $form->field($model, 'idAuto', ['showLabels' => false])->widget(Select2::classname(),[
                        'data' => ArrayHelper::map(Auto::find()->all(), 'idTs', 'gosNum'),
                        'options' => ['placeholder' => 'Select Auto'],
                        'pluginOptions' => ['allowClear' => true],
                        //'id' => 'reload',
                    ])?>
                    
                </div> -->               
                 <div class="col-sm-offset-2">   
                            
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h>Auto</h>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-2">
                                <?= $form->field($modelAuto, 'gosNum', ['showLabels' => false])->textInput(['placeholder' => 'gosNum'])?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelAuto, 'model', ['showLabels' => false])->textInput(['placeholder' => 'model'])?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelAuto, 'V', ['showLabels' => false])->textInput(['placeholder' => 'V'])?>
                            </div>
                        </div>
                    </div>
                </div>       
                    
                
            </div>

            <div class="form-group">
                <?= Html::activeLabel($model, 'ID', ['label' => 'Data Section #3', 'class' => 'col-sm-2 control-label'])?>
                <div class="col-sm-3">
                    <?= $form->field($model, 'point', ['showLabels' => false])->textInput(['placeholder' => 'Point'])?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'idInstaller', ['showLabels' => false])->widget(Select2::classname(),[
                        'data' => ArrayHelper::map(Installer::find()->orderBy('integrator')->all(), 'id', 'integrator'),
                        'options' => ['placeholder' => 'Select installer'],
                        'pluginOptions' => ['allowClear' => true]
                    ])?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'date', ['showLabels' => false])->widget(DatePicker::classname(),[
                            'name' => 'dp_1',
                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                            'value' => '28-May-1989',
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
                    <?= $form->field($model, 'dut', ['showLabels' => false])->textInput(['placeholder' => 'Count Dut'])?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'biz', ['showLabels' => false])->textInput(['placeholder' => 'Count Biz'])?>
                </div>
                <?= Html::activeLabel($model, 'ID', ['label' => 'Moto', 'class' => 'col-sm-1 control-label'])?>
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

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <?= $form->field($model, 'col', ['showLabels' => false])->widget(Select2::classname(),[
                        'data' => ArrayHelper::map(Col::find()->orderBy('comment')->all(), 'id', 'comment'),
                        'options' => ['placeholder' => 'Select status'],
                        'pluginOptions' => ['allowClear' => true]
                    ])?>
                </div>
            </div>

             <div class="form-group">
                <?= Html::activeLabel($model, 'ID', ['label' => 'Комментарий', 'class' => 'col-sm-2 control-label'])?>
                <div class="col-sm-10">
                    <?= $form->field($model, 'comment', ['showLabels' => false])->textArea([
                        'placeholder' => 'your comment',
                        'rows' => 4,
                    ])?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <hr>
                    <?= Html::submitButton('Create', ['class' => 'btn btn-primary'])?>
                    <?= Html::submitButton('Reset', ['class' => 'btn btn-default'])?>
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




JS;

$this->registerJs($script)

?>

