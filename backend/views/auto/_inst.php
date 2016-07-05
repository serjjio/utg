<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Insts';
//$this->params['breadcrumbs'][] = $this->title;
?>

    

    
    <?php
        //$val = $model->comment !=null ? 'more...' : '';
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            
            'date',
            'point',
            'blok',
            [
                'attribute' => 'idInstaller',
                'value' => 'idInstaller0.integrator',

            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'V',
                'hAlign' => 'center'
            ],
            //'dut',
            //'biz',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'moto',
                'filter' => ['1' => 'Есть', '0' => 'Нету']
            ],
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
                    'displayValue' => 'more...',
                    //'data' => [0=>'mrrrr'],

                    
                    //
                    
                    'options' => ['class' => 'form-control', 'rows'=>5, 'placeholder' => 'Enter comment...'],
                ],
            ],
             //'col',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/inst/delete/'.$key, ['data-method' => 'post']);
                    }
                ],
            ],
        ]
    ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed' ],
        'columns' => $columns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        'responsive' => true,
        'responsiveWrap' => true,
        'hover' => true,
        'persistResize' => false,
        'rowOptions' => function($model, $key, $index){
            if($model->col == 2)
                return ['class'=> 'danger'];
            elseif($model->col == 3)
                return ['class'=> 'success'];
            elseif($model->col == 4)
                return ['class'=> 'info'];
            elseif($model->col == 1)
                return ['class'=> 'my'];

        },
        /*'toolbar' => [
            '{toggleData}'
        ],*/

       /* 'panel' => [
            'type' => GridView::TYPE_DEFAULT
        ],*/
    ]); ?>
    
</div>
