
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Inst */

$this->title = 'Документы';
$this->params['breadcrumbs'][] = ['label' => 'Установки', 'url' => ['inst/']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Фото', 'url' => ['inst/foto/'.$id]]

?>
<div class="inst-document">


    <?= $this->render('_form-document', [
        'model' => $model,
        //'images' => $images,
        'id' => $id,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
        

    ]) ?>

</div>

