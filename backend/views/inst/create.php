<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Inst */

$this->title = 'Создание установки';
$this->params['breadcrumbs'][] = ['label' => 'Установки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inst-create">


    <?= $this->render('_form-create', [
        'model' => $model,
        'modelAuto' => $modelAuto
    ]) ?>

</div>
