<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Marka;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php

    $columns = 
    [
        ['class' => 'yii\grid\SerialColumn'],

        //'idmodel',
        [
            'attribute' => 'marka',
            //'value' => 'idMarka.marka',
            'group' => true,
        ],
        'name_model',
            

        ['class' => 'yii\grid\ActionColumn'],
    ];

?>
    <p>
        <?= Html::a('Create Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'toolbar' => [
            '{toggleData}'
        ],
        'panel' => [
            'type' => 'primary',
            'heading' => 'Model'
        ]
    ]); ?>
</div>
