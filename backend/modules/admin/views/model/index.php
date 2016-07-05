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

            <button class="btn btn-sm btn-create" data-attribute-url="/admin/marka/create"><i class="glyphicon glyphicon-plus"></i> Создать марку</button>

            <button class="btn btn-sm btn-create" data-attribute-url="/admin/model/create"><i class="glyphicon glyphicon-plus"></i> Создать модель</button>


HTML;

?>

<!-- <button class="btn btn-sm btn-create">Создать марку <b class="caret"></b></button> -->
<div class="model-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <!-- <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::button('TEst', ['class' => 'btn btn-danger test']) ?>
    </p> -->

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
            'attribute' => 'id_marka',
            'value' => 'idMarka.marka',
            'label' => 'Марка', 
            'group' => true,
            'width' => '40%',
            'filterType' => GridView::FILTER_SELECT2,
               'filter' => ArrayHelper::map(Marka::find()->orderBy('marka')->asArray()->all(), 'Id', 'marka'),
               'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
               ],
               'format' => 'raw',
               'filterInputOptions' => ['placeholder' => 'Марка'],
        ],
        [
            'attribute' => 'name_model',
            'label' => 'Модель',
            'width' => '40%',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Model::find()->orderBy('name_model')->asArray()->all(), 'name_model', 'name_model'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true]
            ],
            'format' => 'raw',
            'filterInputOptions' => ['placeholder' => 'Модель']



        ],
            

        [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/admin/model/update/'.$key,
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
            'heading' => 'Модель',
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
