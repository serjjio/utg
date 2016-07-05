<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Marka;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<?php

$beforePanel = <<<HTML

            <button class="btn btn-sm btn-create" data-attribute-url="/admin/col/create"><i class="glyphicon glyphicon-plus"></i> Создать статус</button>

HTML;

?>

<!-- <button class="btn btn-sm btn-create">Создать марку <b class="caret"></b></button> -->
<div class="col-index">



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
            'attribute' => 'comment',
            'label' => 'Статус', 
            
        ],
        [
            'attribute' => 'color',
            'label' => 'Цвет',
            //'width' => '40%',
            'value' => function ($model, $key, $index, $widget){
                return "<span class='badge' style='background-color:{$model->color}'>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</span><code>".$model->color."</code>";
            },
            'vAlign' => 'middle',
            'noWrap' => true,
            'format' => 'raw',
            //'filterType' => GridView::FILTER_SELECT2,
            //'filter' => ArrayHelper::map(Model::find()->orderBy('name_model')->asArray()->all(), 'name_model', 'name_model'),
            //'filterWidgetOptions' => [
            //    'pluginOptions' => ['allowClear' => true]
            //],
            //'format' => 'raw',
            //'filterInputOptions' => ['placeholder' => 'Модель']



        ],
            

        [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/admin/col/update/'.$key,
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
            'heading' => 'Статус',
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
