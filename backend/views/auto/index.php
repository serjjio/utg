<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\InstSearch;
use app\models\Inst;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auto';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="auto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Auto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php

        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },

                // create GridView
                'detail' => function($model, $key, $index, $column){
                    
                    $searchModel = new InstSearch();
                    
                    $searchModel->idAuto = $model->idTs;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_foto', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                           
                        ]);
                },
               
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true
            ],
            'idTs',
            'gosNum',
            'typeTs',
            'idMarka',
            'model',
            'V',
            'fil',
            'pod',
            'comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ]

    ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed' ],
        'columns' => $columns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        //'pjax'=>true, // pjax is set to always true for this demo
        'responsive' => true,
        'responsiveWrap' => true,
        'hover' => true,
        'persistResize' => false,
        'toolbar' => [
            '{toggleData}'
        ],

        'panel' => [
            'type' => GridView::TYPE_DEFAULT
        ],
    ]); ?>
    
</div>
