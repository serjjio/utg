<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\detail\DetailView;
use app\models\Model;
use app\models\Marka;
use app\models\Fil;
use app\models\Sim;
use app\models\Pod;
use app\models\Auto;
use app\models\Unit;
use app\models\Installer;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
use Yii;

/* @var $this yii\web\View */
/* @var $model app\models\Inst */

?>


     <?php
     
        $attributes = [
            [
                'group' => true,
                'label' => 'Информация об установки',
                'rowOptions' => ['class' => 'success']
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'ID',
                        'label' => 'Установка №',
                        'displayOnly' => true,
                        'valueOtions' => ['style' => 'width:30%']
                    ],
                    [
                        'attribute' => 'date',
                        'displayOnly' => true,

                        //'labelColOptions' => ['float:right'],
                        'label' => 'дата установки',
                        'valueOptions' => ['style' => 'width:30%'],
                        'format' => ['date', 'php:Y-m-d']
                        //'displayOnly' => true,
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'point',
                        
                        //'displayOnly' => true,
                    ],

                    [
                        'attribute' => 'id_fil',
                        'value' => ArrayHelper::getValue(Fil::findOne($model->id_fil), 'fil'),
                        'label' => 'Филиал',
                        

                    ],
                    [
                        'attribute' => 'id_pod',
                        'value' => ArrayHelper::getValue(Pod::findOne($model->id_pod), 'podcol'),
                        'label' => 'Подразделение',
                        

                    ],

                    /*[
                        'attribute' => 'blok',
                        'value' => ArrayHelper::getValue(Unit::findOne($model->blok), 'name_block'),
                        'valueOptions' => ['style' => 'width:30%'],
                        'type' => DetailView::INPUT_SELECT2,
                        'widgetOptions'=>[
                            'data'=>ArrayHelper::map(Unit::find()->orderBy('name_block')->asArray()->all(), 'blok', 'name_block'),
                            'options'=> ['placeholder'=> 'Select...'],
                            'pluginOptions'=>['allowClear'=>true, 'width'=>'130%']
                        ],
                        //'displayOnly' => true,
                    ],*/
                    [
                        'attribute' => 'idInstaller',
                        'format' => 'raw',
                        
                        
                        'value' => ArrayHelper::getValue(Installer::findOne($model->idInstaller), 'integrator'),
                        //'displayOnly' => true,
                        
                    ],
                    
                    
                    
                ],
            ],
            [
                'group' => true,
                'label' => 'Детальная информация об атомобиле',
                'rowOptions' => ['class' => 'info']
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'idAuto',
                        'label' => 'Гос номер',
                        'value' => $modelAuto->gosNum,
                        //'value' => $modelAuto->gosNum,
                        //'displayOnly' => true,

                    ],

                    [
                        'attribute' => 'idAuto',
                        'label' => 'Марка',
                        'value' => ArrayHelper::getValue(Marka::findOne($modelAuto->idMarka), 'marka'),
                        'displayOnly' => true,

                    ],
                    [
                        'attribute' => 'idAuto',
                        'label' => 'Модель',
                        'value' => ArrayHelper::getValue(Model::findOne($modelAuto->id_model), 'name_model'),
                        'displayOnly' => true,

                    ],
                    

                ],
                
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'V',
                        'hAlign' => 'right',

                    ],
                    [
                        'attribute' => 'dut',
                        'label' => 'Количество ДУТ',

                        //'format'=> ['decimal', 0]
                        //'inputContainer' => ['class' => 'col-sm-6']
                    ],
                    [
                        'attribute' => 'biz',
                        'label' => 'Количество Бизов',


                    ],
                    [
                        'attribute' => 'moto',
                        'label' => 'Моточасы?',
                        'format' => 'raw',
                        'value'=>$model->moto ? '<span class="label label-success">Есть</span>' : '<span class="label label-danger">Нету</span>',
                        'type' => DetailView::INPUT_SWITCH,

                    ],
                ]
            ],
            [
                'columns' => [
                     [
                        'attribute' => 'idAuto',
                        'label' => 'Инвентарный номер',
                        'value' => $modelAuto->inv,

                    ]
                ],
            ],
            [
                'group' => true,
                'label' => 'Информация о блоке',
                'rowOptions' => ['class' => 'success']
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'blok',
                        'value' => $modelUnit->name_block,
                        //'valueOptions' => ['style' => 'width:30%'],
                    ],
                    [
                        'attribute' => 'blok',
                        'label' => 'IMEI',
                        'value' => $modelUnit->IMEI,
                        //'valueOptions' => ['style' => 'width:30%'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'blok',
                        'label' => 'СИМ',
                        'value' => ArrayHelper::getValue(Sim::findOne($modelUnit->idSim), 'SIM'),
                    ],
                    [
                        'attribute' => 'blok',
                        'label' => 'ICC',
                        'value' => ArrayHelper::getValue(Sim::findOne($modelUnit->idSim), 'icc'),
                    ],
                ]
            ],
            
            [
                'group' => true,
                'label' => 'Комментарий',
                'rowOptions' => ['class' => 'info']
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'comment',
                        'format' => 'raw',
                        'label' => 'Comment',
                        'value' => '<span class="text-justify"><em>' . $model->comment . '</em></span>',
                        'type' => DetailView::INPUT_TEXTAREA,
                        'options' => ['rows'=>4]
                        

                    ]
                ],
            ],
            

        ]

    ?>
    
    <?php


        echo DetailView::widget([
                
                'model' => $model,
                'condensed' => true,
                'hover' => true,
                'attributes' => $attributes,
                'responsive' => true,
                'mode' => 'view',
                
                'formOptions' => [
                    'options' => ['data-pjax' => 0],
                    'enableClientValidation' => true
                    //'action' => Url::to('delete')
                ],
            ]);


   

/*$this->registerJs("
        $('#{$pjax->getId()}').on('pjax:end', function(e){
            
        })
    ")*/



    ?>

