<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\detail\DetailView;
use app\models\Model;
use app\models\Marka;
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
                        'valueOptions' => ['style' => 'width:30%'],
                        'inputWidth' => '90px',
                        //'displayOnly' => true,
                    ],
                    [
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
                    ],
                    [
                        'attribute' => 'idInstaller',
                        'format' => 'raw',
                        'inputWidth' => '150px',
                        'valueOptions' => ['style' => 'width:30%'],
                        'value' => ArrayHelper::getValue(Installer::findOne($model->idInstaller), 'integrator'),
                        'type' => DetailView::INPUT_SELECT2,
                        'widgetOptions'=>[
                            'data'=>ArrayHelper::map(Installer::find()->orderBy('integrator')->asArray()->all(), 'id', 'integrator'),
                            'options'=> ['placeholder'=> 'Select...'],
                            'pluginOptions'=>['allowClear'=>true, 'width'=>'100%']
                        ],
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
                        'attribute' => 'V',
                        'hAlign' => 'right',
                        'labelColOptions' => ['style'=>'width:10%; text-align:right'],
                        'valueOtions' => ['style' => 'width:25%'],
                        'inputWidth' => '50px',
                    ],
                    [
                        'attribute' => 'dut',
                        'label' => 'Количество ДУТ',
                        'valueOtions' => ['style' => 'width:25%'],
                        'inputWidth' => '50px',
                        //'format'=> ['decimal', 0]
                        //'inputContainer' => ['class' => 'col-sm-6']
                    ],
                    [
                        'attribute' => 'biz',
                        'label' => 'Количество Бизов',
                        'valueOtions' => ['style' => 'width:25%'],
                        'inputWidth' => '50px',

                    ],
                    [
                        'attribute' => 'moto',
                        'label' => 'Моточасы?',
                        'format' => 'raw',
                        'value'=>$model->moto ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
                        'type' => DetailView::INPUT_SWITCH,
                        'widgetOptions' => [
                            'pluginOptions' => [
                                'onText' => 'Есть',
                                'offText' => 'Нету',
                            ]
                        ],
                        'labelColOptions' => ['style'=>'width:15%; text-align:right'],
                        'valueOtions' => ['style' => 'width:25%']
                    ],
                ]
            ],
            [
                'group' => true,
                'label' => 'Автомобиль',
                'rowOptions' => ['class' => 'info']
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'idAuto',
                        'label' => 'Гос номер',
                        'value' => ArrayHelper::getValue(Auto::findOne($model->idAuto), 'gosNum'),
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
                        'attribute' => 'idAuto',
                        'label' => 'Инвентарный номер',
                        'value' => empty($modelAuto->inv) ? '' : $modelAuto->inv,
                        'displayOnly' => true,
                    ]
                ],
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
                'panel'=> [
                    'heading'=> 'Детали установки',
                    'type'=>DetailView::TYPE_INFO,
                ],
                'deleteOptions' => [
                    'params' => ['id' => $model->ID, 'kvdelete'=>true],
                    'url'=>'inst/inactive',
                    'confirm' => 'Вы действительно хотите удалить установку?',
                ],
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

