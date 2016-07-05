<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Auto */

$this->title = 'Update Auto: ' . $model->idTs;
$this->params['breadcrumbs'][] = ['label' => 'Autos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTs, 'url' => ['view', 'id' => $model->idTs]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
