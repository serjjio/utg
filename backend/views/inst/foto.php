
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Inst */

$this->title = 'Фото';
$this->params['breadcrumbs'][] = ['label' => 'Установки', 'url' => ['inst/']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['inst/file/'.$id]]

?>
<div class="inst-image">


    <?= $this->render('_form-foto', [
        'model' => $model,
        //'images' => $images,
        'id' => $id,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig

    ]) ?>

</div>

