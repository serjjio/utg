<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unit */

$this->title = 'Update Unit: ' . $model->blok;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->blok, 'url' => ['view', 'id' => $model->blok]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-update">


    <?= $this->render('_form', [
        'modelUnit' => $modelUnit,
    ]) ?>

</div>
