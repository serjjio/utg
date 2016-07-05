<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\AutoSearch;
use app\models\Auto;
use app\models\Fil;
use app\models\Inst;
use app\models\Col;
use app\models\InstSearch;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel app\models\InstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Установки';
$this->params['breadcrumbs'][] = $this->title;

$layout = <<< HTML
<div class="pull-left">
    {export}
</div>

HTML;

?>



<div class="inst-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <!-- <p>
        <?= Html::a('DownLoad', ['inst/download/19'], ['class' => 'btn btn-danger']) ?>
    </p> -->
    <div id="myModal">
    <?php
//Pjax::begin(['id'=>'detail']);
        Modal::begin([
                //'header'=>'<h4 class="moadl-tittle">Detail Inst</h4>',
                'options' => ['tabindex' => false],
                'id' => 'root',

            ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
//Pjax::end();
    ?>
    <? 
        if (Yii::$app->session->hasFlash('kv-detail-success')){
            Alert::begin([
                'options' => ['class'=>'alert-success']
            ]);
                echo Yii::$app->session->getFlash('kv-detail-success');
            Alert::end();
        }
    ?>


    <?php
        //$val = $model->comment !=null ? 'more...' : '';
        $color_status = ArrayHelper::map(Col::find()->orderBy('comment')->asArray()->all(), 'id', 'comment');
        
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detailUrl' => Url::to('/inst/inst-detail')
                /*'detail' => function($model, $key, $index, $column){
                    $searchModel = new InstSearch();
                    $searchModel->ID = $model->ID;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_auto', [
                            'model' => $dataProvider,
                        ]);
                }*/
            ],

            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'date',
                'format' => ['date', 'php:Y-m-d']
            ],
            /*[
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column){
                    $modelAuto = Auto::findOne($model->idAuto);
                    $modelInst = Inst::findOne($key);
                    $searchModel = new InstSearch();
                    $searchModel->ID = $model->ID;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    
                    return Yii::$app->controller->renderPartial('_detail-auto', [
                            'modelAuto' => $modelAuto,
                            'modelInst' => $modelInst,
                            'dataProvider' => $dataProvider,
                            
                        ]);
                }
            ],*/
            [
                'attribute' => 'idAuto',
                'vAlign' => 'middle',
                'value' => 'idAuto0.gosNum',
                /*'value' => function($model, $key, $index){
                    return Html::a(ArrayHelper::getValue(Auto::findOne($model->idAuto), 'gosNum'), '#root',
                            //[Url::to('inst/'.$key)],
                            [
                                //'data-toggle' => 'modal',
                                'data-target'=>'#root',
                                'data-attribute-url' => Url::to('/inst/'.$key),
                                'class' => 'modalLink',
                            ]
                        );
                },*/

               'filterType' => GridView::FILTER_SELECT2,
               'filter' => ArrayHelper::map(Auto::find()->orderBy('gosNum')->asArray()->all(), 'idTs', 'gosNum'),
               'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
               ],
               'format' => 'raw',
               'filterInputOptions' => ['placeholder' => 'Госномер'],

            ],

            [
                'attribute' => 'blok',
                'value' => 'blok0.name_block'
            ],

            [
                'attribute' => 'id_pod',
                'value' => 'idPod0.podcol',
                'label' => 'Подразделение',
                'hAlign' => 'center',
            ],

            [
                'attribute' => 'id_fil',
                'value' => 'idFil0.fil',
                'label' => 'Филиал',
                'hAlign' => 'center',
            ],
            
            [
                'attribute' => 'point',
                'hAlign' => 'center'
                /*'width' => '130px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Inst::find()->orderBy('point')->asArray()->all(), 'ID', 'point'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
               ],
               'format' => 'raw',
               'filterInputOptions' => ['placeholder' => 'Any point...'],*/
            ],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'col',
                'value' => 'col0.comment',
                'hAlign' => 'center',
                'width' => '130px',
               'filterType' => GridView::FILTER_SELECT2,
               'filter' => $color_status,
               'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
               ],
               'format' => 'raw',
               'filterInputOptions' => ['placeholder' => 'Статус'],
               'editableOptions' => [
                    'inputType' => 'dropDownList',
                    'header' => 'Status',
                    'data' => $color_status,
               ],
               
            ],
            
            /*[
                'class' => 'kartik\grid\EditableColumn',

                //'header' => 'Point',
                'attribute' => 'comment',
                //'value' => '1234',
                'editableOptions' => [
                    'asPopover' => false,
                    'header' => 'Comment',
                    'inputType'=> 'textArea',
                    'submitOnEnter' => false,
                    'size' => 'lg',
                    'valueIfNull' => 'no comment',
                    //'displayValue' => function(){return "mor....";},
                    //'data' => [0=>'mrrrr'],

                    
                    //
                    
                    'options' => ['class' => 'form-control', 'rows'=>5, 'placeholder' => 'Enter comment...'],
                ],
            ],*/
            
           /* [
                'class' => 'kartik\grid\EditableColumn',
                //'header' => 'Point',
                'attribute' => 'point',
                
                'editableOptions' => [
                    'header' => 'City',
                    'inputType'=> 'textInput',
                ],
            ],*/
            /*[
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column){
                    $searchModel = new AutoSearch();
                    $searchModel->idTs = $model->idAuto;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_auto', [
                            'serachModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]);
                }
            ],*/
            /*[
                'attribute' => 'idAuto',
                'value' => 'idAuto0.gosNum',

            ],*/
            
            /*[
                'attribute' => 'idInstaller',
                'value' => 'idInstaller0.integrator',
                'label' => 'Installer',

            ],*/
            
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'V',
                'hAlign' => 'center',
                'filterType' => GridView::FILTER_SELECT2,
                'filterInputOptions' => ['placeholder' => 'Вольтаж'],
                'filter' => ['12'=>'12', '24'=>'24'],
                'width' => '100px',
               'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
               ],

            ],
            //'dut',
            /*[
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'dut',
                'editableOptions' => [
                    'header' => 'Dut',
                    'inputType'=> 'textInput',
                ],

            ],*/
            //'biz',
            //'moto',
            /*[
                'class' => 'kartik\grid\EditableColumn',

                //'header' => 'Point',
                'attribute' => 'comment',
                //'value' => '1234',
                'editableOptions' => [
                    'asPopover' => false,
                    'header' => 'Comment',
                    'inputType'=> 'textArea',
                    'submitOnEnter' => false,
                    'size' => 'lg',
                    'valueIfNull' => 'no comment',
                    //'displayValue' => function(){return "mor....";},
                    //'data' => [0=>'mrrrr'],

                    
                    //
                    
                    'options' => ['class' => 'form-control', 'rows'=>5, 'placeholder' => 'Enter comment...'],
                ],
            ],*/
             //'col',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {foto} {document}',
                /*'urlCreator' => function($action, $model, $key, $index){
                    if ($action === 'view'){
                        $url = Url::toRoute(['inst/foto/'.$key]);;
                        return $url;
                    }
                },*/
                'buttons' => [

                    'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/inst/update/'.$key,
                                        'data-target'=>'#root',
                                        'class' => 'modalLink',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                        },

                    'foto' => 
                        function($url, $model){
                            return Html::a('<span class="glyphicon glyphicon-camera"></span>', ['inst/foto/'.$model->ID],
                                [
                                    'title' => Yii::t('app', 'Фото'),
                                    'data-pjax' => '0'
                                ]);
                        },
                    'slide' => 
                        function($url, $model){
                            return Html::a('<span class="glyphicon glyphicon-star"></span>', ['inst/slide/'.$model->ID],
                                [
                                    'title' => Yii::t('app', 'Слайд'),
                                    'data-pjax' => '0'
                                ]);
                        },
                    'document' => 
                        function($url, $model){
                            return Html::a('<span class="glyphicon glyphicon-file"></span>', ['inst/file/'.$model->ID],
                                [
                                    'title' => Yii::t('app', 'Документы'),
                                    'data-pjax' => '0'
                                ]);
                        }
                    
                ],
                /*'urlCreator' => function($action, $model, $key, $index){
                    if ($action === 'view'){
                        $url = '/yii2-app-advanced/backend/web/inst/foto/'.$key;
                        return $url;
                    }
                }*/
                
            ],
        ]
    ?>

<?php
    $columnsExport = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'date',
                'format' => ['date', 'php:Y-m-d'],
                'label' => 'Дата',
            ],
            [
                'attribute' => 'idAuto',
                'vAlign' => 'middle',
                'value' =>'idAuto0.gosNum'
            ],

            [
                'attribute' => 'blok',
                'value' => 'blok0.name_block'
            ],

            [
                'attribute' => 'id_pod',
                'value' => 'idPod0.podcol',
                'label' => 'Подразделение',
                'hAlign' => 'center',
            ],

            [
                'attribute' => 'id_fil',
                'value' => 'idFil0.fil',
                'label' => 'Филиал',
                'hAlign' => 'center',
            ],
            
            [
                'attribute' => 'point',
                'hAlign' => 'center'
            ],

            [
                'attribute' => 'col',
                'value' => 'col0.comment',
                'hAlign' => 'center',
                'width' => '130px',
                'format' => 'raw',    
            ], 
            
            [
                'attribute' => 'V',
                'hAlign' => 'center',
                'width' => '100px',
            ],
            [
                'attribute' => 'dut',
                'hAlign' => 'center',
                'width' => '100px',
            ],
            [
                'attribute' => 'biz',
                'hAlign' => 'center',
                'width' => '100px',
            ],
            [
                'attribute' => 'moto',
                'hAlign' => 'center',
                'width' => '100px',
            ],
            [
                'attribute' => 'comment',
                'hAlign' => 'center',
                'width' => '100px',
            ],

            
        ]
    ?>



    <?php

        $fullExport = ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $columnsExport,
                'filename' => 'Установки',
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    //ExportMenu::FORMAT_PDF => true,
                    //ExportMenu::FORMAT_CSV => false,
                    //ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_EXCEL => false,

                    ExportMenu::FORMAT_HTML => [
                        'label' => Yii::t('app', 'HTML'),
                        'alertMsg' => Yii::t('app', 'HTML файл экспорта будет создан для скачивания'),
                        'showHeader' => true,
                        'showPageSummary' => true,
                        'showFooter' => true,
                        'showCaption' => true,
                        
                        'mime' => 'text/html',
                        'extension' => 'html',
                        'writer' => 'HTML',
                        'config' => [
                            'cssFile' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'
                        ],
                    ],

                    ExportMenu::FORMAT_EXCEL_X => [
                        'label' => Yii::t('app', 'Excel (xlsx)'),
                        'alertMsg' => Yii::t('app', 'Excel файл экспорта будет создан для скачивания')
                    ],
                    ExportMenu::FORMAT_PDF => [
                        'label' => Yii::t('app', 'PDF'),
                        //'alertMsg' => Yii::t('app', 'PDF файл экспорта будет создан для скачивания'),
                        'linkOptions' => [],
                        'mime' => 'application/pdf',
                        'extension' => 'pdf',
                        'writer' => 'PDF',
                        'filetype' => 'pdf'
                    ],

                ],
                //'noExportColumns' => ['8'],
                'pdfLibraryPath' => '@vendor/kartik-v/mpdf',
                'pdfLibrary' => PHPExcel_Settings::PDF_RENDERER_MPDF,
                'fontAwesome' => true,
                'target' => ExportMenu::TARGET_POPUP,
                'pjaxContainerId' => 'kv-pjax-container',
                'options' => ['class' => 'hidden-xs'],

                'dropdownOptions' => [
                    'label' => 'Экспорт',
                    //'title' => Yii::t('app', 'Экспорт данных таблици'),
                    'class' => 'btn btn-default',
                    /*'itemsBefore' => [
                        '<li class="dropdown-header">Экспорт данных</li>',
                    ],*/
                ],
                /*'columnSelectorOptions' => [
                    'title' => Yii::t('app', 'Выберите колонки для экспорта')
                ],*/
                /*'columnBatchToggleSettings' => [
                    'label' => 'Выбрать все'
                ],*/
                /*'messages' => [
                    'allowPopups' => Yii::t('app', 'Отключите все блокировщики всплывающих окон в вашем браузере, чтобы обеспечить правильную загрузку'),
                    'confirmDownload' => Yii::t('app', 'Хотите продолжить?'),
                    'downloadProgress' => Yii::t('app', 'Создание файла. Пожалуйста, подождите...'),
                    'downloadComplete' => Yii::t('app', 'Загрузка завершена. Можете закрыть окно'),
                    
                ],*/

            ])



    ?>





    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed' ],
        'columns' => $columns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'responsive' => false,
        'responsiveWrap' => false,
        'hover' => true,
        'persistResize' => false,
        'rowOptions' => function($model, $key, $index){
            $color = ArrayHelper::getValue(Col::findOne($model->col), 'color');
            return ['style'=> 'background-color:'.$color];
            /*if($model->col == 2)
                return ['style'=> 'background-color:'.$model->id_col];
            elseif($model->col == 3)
                return ['style'=> 'background-color:'.$model->id_color];
            elseif($model->col == 4)
                return ['style'=> 'background-color:'.$model->id_col];
            elseif($model->col == 1)
                return ['style'=> 'background-color:'.$model->id_col];*/
                //return ['class'=> 'my'];

        },
        'toggleDataOptions' => [
            'type'=>30,
        ],
        //'layout' => $layout,
        //'panelBeforeTemplate' => '{toolbar}',
        'toolbar' => [
            
            'content' => 
                $fullExport,
            
            
        ],

        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            //'type' => 'success',
            'heading' => 'Установки',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Создать установку', ['create'], ['data-pjax'=>0, 'class'=> 'btn create', 'title' => Yii::t('app', 'Создать установку')]),
        ],
    ]); ?>
</div>


