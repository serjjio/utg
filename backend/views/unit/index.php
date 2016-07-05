<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\Unit;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\web\JsExpression;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel app\models\InstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блоки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inst-index">
<!-- <?= Html::a('Button', ['unit/test'], ['class' => 'btn btn-danger', 'target' => '_blank', 'data-toggle' => 'tooltip'])?> -->
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
     <!-- <p>
        <?= Html::button('Create', ['type' => 'button', 'class' =>'btn btn-danger', 'id'=>'create-unit', 'data-url'=> 'unit/create'])?>
    </p> --> 
    <div id="myModal">
    <?php
//Pjax::begin(['id'=>'detail']);
        Modal::begin([
                'options' => ['tabindex' => false],
                'id' => 'unit',

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
       $config = empty($model->idConfig) ? '' : $model->idConfig;
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name_block',
                'label' => 'Номер блока',
                'hAlign' => 'center',
                'width' => '150px',
                //'value' => $model->blok,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Unit::find()->asArray()->all(), 'name_block', 'name_block'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear'=>true, 
                        
                        'language' => [
                            'noResults' => new JsExpression("function () {return 'Совпадений не найдено'}")
                        ]
                    ],
                ],
                'format' => 'raw',
                'filterInputOptions' => ['placeholder' => 'Номер блока'],
            ],
            [
                'attribute' => 'IMEI',
                'label' => 'IMEI',
                'hAlign' => 'center',
            ],
            [
                //'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'idSim',
                'value' => 'idSim0.SIM',
                'label' => 'Номер СИМ-карты',
                'hAlign' => 'center',
            ],
            [
                'attribute' => 'idICC',
                'hAlign' => 'center',
                'label' => 'ICC',
                'value' => 'idICC0.icc'
            ],
            [
                'attribute' => 'idConfig',
                'label' => 'Конфигурация',
                //'value' => $config,
            ],
            
            [
                'attribute' => 'idFw',
                'label' => 'Прошивка',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => 
                            function($url, $model){
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['unit/update/'.$model->blok], 
                                    [
                                        'class' => 'create-unit',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                            }
                ]

            ]
            
        ]
    ?>
    
    <?php

        $fullExport = ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $columns,
                'filename' => 'Блоки',
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
                'pdfLibraryPath' => '@vendor/kartik-v/mpdf',
                'pdfLibrary' => PHPExcel_Settings::PDF_RENDERER_MPDF,
                'fontAwesome' => true,
                'target' => ExportMenu::TARGET_BLANK,
                'pjaxContainerId' => 'kv-pjax-container',
                'options' => ['style' => 'color:red'],
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
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed' ],
        'columns' => $columns,
        'pjax' => true,
        'pjaxSettings' => [
                'options' => [
                    'id' => 'kv-pjax-container'
                ],
        ],
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        
        'layout' => $layout,

        'responsive' => true,
        'responsiveWrap' => true,
        'hover' => true,
        'persistResize' => false,
       
        'toggleDataOptions' => [
            'type'=>30,
        ],

        'toolbar' => [
            
                '{export}',
                $fullExport,
             
            
            //$fullExport,
        ],
        'export' => [
            'target' => '_self'
        ],
        
        

        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            //'type' => 'success',
            'heading' => 'Блоки',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить блок', 
                            ['create'], 
                            [
                                'data-pjax'=>1, 
                                'class'=> 'btn create create-unit', 
                                'title' => Yii::t('app', 'Добавить блок'),
                            ])

        ],
    ]); ?>
</div>


<?php

?>






