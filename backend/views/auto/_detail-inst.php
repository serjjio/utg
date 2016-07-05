<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Insts';
//$this->params['breadcrumbs'][] = $this->title;


?>


    <?php
    
        $attributes = [
            [
                'group' => true,
                'label' => 'SECTION 1: Identification Information.',
                'rowOptions' => ['class' => 'info']
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'ID',
                        'label' => 'Inst #',
                        'displayOnly' => true,
                        'valueOtions' => ['style' => 'width:30%']
                    ]
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'point',
                        'valueOptions' => ['style' => 'width:30%']
                    ],
                    
                ],
            ],
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
                        'value'=> '<span class="text-justify"><em>'. $model->comment. '</em></span>',
                        'type' => DetailView::INPUT_TEXTAREA,
                        'options' => ['rows'=>4]
                    ]
                ]
            ],

        ]

    ?>
    
    <?php

        echo DetailView::widget([
                'model' => $model,
                'condensed' => true,
                'hover' => true,
                'attributes' => $attributes,
                'mode' => 'view'
            ])


    ?>
     
    
</div>