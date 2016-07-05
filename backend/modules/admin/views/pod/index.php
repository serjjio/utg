<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Fil;
use app\models\Pod;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<?php

$beforePanel = <<<HTML

            <button class="btn btn-sm btn-create" data-attribute-url="/admin/fil/create"><i class="glyphicon glyphicon-plus"></i> Создать филиал</button>

            <button class="btn btn-sm btn-create" data-attribute-url="/admin/pod/create"><i class="glyphicon glyphicon-plus"></i> Создать подразделение</button>


HTML;

?>

<!-- <button class="btn btn-sm btn-create">Создать марку <b class="caret"></b></button> -->
<div class="model-index">


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
//Марка создана! Можете создать еще, либо закройте окно!

?>



<?php

    $columns = 
    [
        ['class' => 'yii\grid\SerialColumn'],

        //'idmodel',
        [
            'attribute' => 'idFil',
            'value' => 'idFil0.fil',
            'label' => 'Филиал', 
            'group' => true,
            'width' => '40%',
            'filterType' => GridView::FILTER_SELECT2,
               'filter' => ArrayHelper::map(Fil::find()->orderBy('fil')->asArray()->all(), 'idfil', 'fil'),
               'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
               ],
               'format' => 'raw',
               'filterInputOptions' => ['placeholder' => 'Филиал'],
        ],
        [
            'attribute' => 'podcol',
            'label' => 'Модель',
            'width' => '40%',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Pod::find()->orderBy('podcol')->asArray()->all(), 'podcol', 'podcol'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true]
            ],
            'format' => 'raw',
            'filterInputOptions' => ['placeholder' => 'Подразделение']



        ],
            

        [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/admin/pod/update/'.$key,
                                        'data-target'=>'#root',
                                        'class' => 'modalLink',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                        }
                ]
            ],
    ];

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
            'heading' => 'Подразделение',
            'before' => $beforePanel,
        ]
    ]); ?>
</div>


<?php
$script = <<<JS

$('.test').on('click', function(){
    $.pjax.reload({container:'#model-pjax-container'})
})

JS;


$this->registerJs($script);
?>
