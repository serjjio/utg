<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Marka;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MarkaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="sim-index">

<?php

    Modal::begin([
                'options' => ['tabindex' => false],
                'id' => 'root',
                'size' => 'modal-sm',
                'options' => ['tabindex' => false]

            ]);
        echo "<div id='alert-message' style='display:none'></div>";
        echo "<div id='modalContent'></div>";
        Modal::end();


?>

<?php

    $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            //'Id',
            'SIM',
            'icc',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/admin/sim/update/'.$key,
                                        'data-target'=>'#root',
                                        'class' => 'modalLink',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                        }
                ]
            ],
        ]

?>

<?php

$beforePanel = <<<HTML

            <button class="btn btn-sm btn-create" data-attribute-url="/admin/sim/create"><i class="glyphicon glyphicon-plus"></i> Создать СИМ-карту</button>
HTML;

?>


<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'model-pjax-container']],
        'striped' => true,
        'hover' => true,
        'beforeFooter' => 'My fancy content',
        'toolbar' => [
            '{toggleData}'
        ],
        'panel' => [
            'type' => 'primary',
            'heading' => 'СИМ-карты',
            'before' => $beforePanel,
        ]
    ]); ?>


</div>
