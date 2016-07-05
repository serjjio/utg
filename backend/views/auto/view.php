<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Auto */

$this->title = $model->idTs;
$this->params['breadcrumbs'][] = ['label' => 'Autos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idTs], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idTs], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idTs',
            'gosNum',
            'typeTs',
            'idMarka',
            'model',
            'V',
            'fil',
            'pod',
            'comment:ntext',
        ],
    ]) ?>

</div>
