<?php

use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="panel panel-success">
    <div class="panel-heading" style="background-color: #3CB371; color: white">
        <h>Документы</h>
    </div>
    <div class="panel-body my-panel">

    <?php

  $download = <<< HTML
    
    <button class="kv-file-download btn btn-xs btn-default download-doc" {dataKey} title="Скачать документ">
        <i class="glyphicon glyphicon-floppy-save"></i>
    </button>
   <!--
   <button class="kv-file-remove btn btn-xs btn-default download" {dataKey} value="inst/create" title="Скачать документ">
        <i class="glyphicon glyphicon-grain"></i>
    </button>
    
    <a href="#" {dataKey} class="text-info download-doc btn btn-xs btn-default"><i class="glyphicon glyphicon-floppy-save"></i></a>
    -->
        
    

HTML;

    ?>

    <?php

    	echo FileInput::widget([
                //'name' => 'Test',
    			'model' => $model,
    			'attribute' => 'doc_file',
    			'options' => [
    				'multiple' => true,
    				//'accept' => 'doc/*',
    			],
    			'language' => 'ru',
    			'pluginOptions' => [
                    'browseClass' => 'btn btn-success',
    				'uploadUrl' => Url::to(['inst/doc-upload']),
    				'uploadExtraData' => [
    					'id_inst' => $id,
    				],
                    'previewZoomSettings' => [
                        'image' => ['width' => 'auto', 'height'=> '100%'],
                        //'text' => ['width' => '100%', 'min-height'=> '480px'],
                        'flash' => ['width' => 'auto', 'height'=> '480px'],
                        'object' => ['width' => 'auto', 'height'=> '480px'],
                        'pdf' => ['width' => '100%', 'height'=>'100%', 'min-height'=> '480px'],
                        'other' => ['width' => 'auto',  'max-height'=> '90%'],
                    ],
    				//'pweviewFileType' => 'any',
    				'showPreview' => true,
    				'initialPreview' => $initialPreview,
    				'initialPreviewAsData' => true,
    				'uploadAsync' => true,
    				'overwriteInitial' => false,
    				//'initialCaption' => '',
    				'initialPreviewConfig' => $initialPreviewConfig,
    				//'maxFileSize' => 2800,
    				//'showCaption' => false,
    				//'elCaptionText' => '#customCaption',
    				'browseLabel' => 'Выберите файлы',
    				'dropZoneEnabled' => true,
    				//'maxImageWidth' => 100,
    				//'sortThumbs' => false,
    				//'autoReplace' => false,
                   'otherActionButtons' => $download,
                    
                    

                            /*Html::button('<i class="glyphicon glyphicon-plus"></i>', ['value'=>'inst/download','class'=>'kv-file-remove btn btn-xs btn-default download', 'title'=>'Скачать документ']),*/
                            //Html::button("sd", ['class'=>'kv-file-remove btn btn-xs btn-default']),
                           //Html::a('<i class="glyphicon glyphicon-plus"></i>',['inst/download']),
                    

    				//'initialPreviewShowDelete' => true,
                    //'allowedPreviewTypes' => null,
                    //'previewFileIcon' => '<i class="fa fa-file"></i>',
                    'previewFileIconSettings' => [
                        'docx' => '<i class="fa fa-file-word-o text-primary"></i>',
                        //'zip' => '<i class="fa fa-file-word-o text-primary"></i>',

                    ]
    			]
    		]);
    	//echo '<span id="customCaption" class="text-success">No file selected</span>'

    ?>


	</div>
</div>


<?php
$script = <<<JS

/*$('.download').on('click', function(){
    var key = $(this).attr('data-key');
    var url = $(this).attr('value')

    $.ajax({
        url: url,
        type: "POST",
        data: ({key:key}),
        success: function(data){
            $('body').append('<iframe src= "' + data + '" class="hiddenFrame></iframe>">');


        }
    })
})*/
$('.download-doc').click(function(){
    var key = $(this).attr('data-key');
    //var url = $(this).attr('value');
    var url = "/inst/download-doc/"
    //alert(url)
    $('body').append('<a href="'+url+ key+'" style="display:none" id="clickk"></a>');
    document.getElementById('clickk').click();
    $('#clickk').remove();
});

/*$('.download-doc').click(function(e){
    
    var key = $(this).attr('data-key');
   
    var url = '/inst/download-doc/';
    //alert(url);
    
    $('.download-doc').attr('href', url + '12');
    $('.download-doc').attr('href', url+ key);

    
})*/
JS;


$this->registerJs($script);
?>

