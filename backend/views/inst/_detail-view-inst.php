<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\detail\DetailView;
use app\models\Marka;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Insts';
//$this->params['breadcrumbs'][] = $this->title;

/*$out = ArrayHelper::getValue(Marka::findOne(54), 'marka');
print_r($out);
exit;*/

?>


    <?php
    
        $attributes = [
            [
                'group' => true,
                'label' => 'SECTION 1: Identification Information.',
                'rowOptions' => ['class' => 'success']
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'idTs',
                        'label' => 'Auto #',
                        'displayOnly' => true,
                        'valueOtions' => ['style' => 'width:30%']
                    ]
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'gosNum',
                        'valueOptions' => ['style' => 'width:30%'],
                        //'displayOnly' => true,
                    ],
                    [
                        'attribute' => 'idMarka',
                        'value' => ArrayHelper::getValue(Marka::findOne($modelAuto->idMarka), 'marka'),
                        'valueOptions' => ['style' => 'width:30%'],
                        //'displayOnly' => true,
                    ],
                    [
                        'attribute' => 'model',
                        'valueOptions' => ['style' => 'width:30%'],
                        //'displayOnly' => true,
                    ],
                    
                    
                ],
            ],
            [
                'group' => true,
                'label' => 'SECTION 2: Comment',
                'rowOptions' => ['class' => 'info']
            ],
            [
                'columns' => [
                    [
                        //'attribute' => 'comment',
                        'label' => 'comment',
                        'value' => $modelInst->comment,
                    ]
                ],
            ],
            

        ]

    ?>
    
    <?php
    
        //Pjax::begin(['id'=>'detail']);
        echo DetailView::widget([
                'model' => $modelAuto,
                'condensed' => true,
                'hover' => true,
                'attributes' => $attributes,
                'responsive' => true,
                'mode' => 'view',
                'panel'=> [
                    'heading'=> 'Inst Comment',
                    'type'=>DetailView::TYPE_INFO,
                ],
            ]);
        //Pjax::end();

    ?>
    <?php

        /*echo DetailView::widget([
                'model' => $modelInst,
                'condensed' => true,
                'hover' => true,
                'attributes' => [
                    [
                        'group' => true,
                        'label' => 'SECTION 3: Inst Comment.',
                        'rowOptions' => ['class' => 'info']
                    ],
                    [
                        'columns' => [
                            [
                                'attribute' => 'comment',
                                'format' => 'raw',
                                'value'=> '<span class="text-justify"><em>'. $modelInst->comment. '</em></span>',
                                'type' => DetailView::INPUT_TEXTAREA,
                                'options' => ['rows'=>4]
                            ]
                        ]
                    ],
                ],
                'panel'=> [
                    'heading'=> 'Inst Comment',
                    'type'=>DetailView::TYPE_INFO,
                ],
                'mode' => 'view'
            ])*/

       /* echo Editable::widget([
                'model'=> $modelInst,
                'attribute'=>'comment',
                'asPopover' => false,
                'inputType'=>Editable::INPUT_TEXTAREA,
                'options' => [
                    'rows' => 5,
                ]
            ])*/

        ?>


             <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed' ],
        'columns' => [
            [
                'class' => 'kartik\grid\EditableColumn',

                //'header' => 'Point',
                'attribute' => 'comment',
                //'value' => '1234',
                'editableOptions' => [
                    'asPopover' => false,
                    'header' => 'Comment',
                    'inputType'=> 'textArea',
                    'submitOnEnter' => false,
                    'size' => 'lg',
                    'valueIfNull' => 'no comment',
                    //'displayValue' => function(){return "mor....";},
                    //'data' => [0=>'mrrrr'],

                    
                    //
                    
                    'options' => ['class' => 'form-control', 'rows'=>5, 'placeholder' => 'Enter comment...'],
                ],
                ],
                ],
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        'responsive' => true,
        'responsiveWrap' => true,
        'hover' => true,
        'persistResize' => false,
        
        'toggleDataOptions' => [
            'type'=>30,
        ],
        'toolbar' => [
            //'{toggleData}'
        ],

        'panel' => [
            'type' => GridView::TYPE_DEFAULT
        ],
    ]); ?>  -->
</div>


