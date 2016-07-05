<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pod-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pod', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idpod',
            'podcol',
            'idFil',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
