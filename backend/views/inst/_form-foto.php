<?php

use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h>Фотогалерея</h>
    </div>
    <div class="panel-body my-panel">

    <?php
  $download = <<< HTML
    
    <button class="kv-file-download btn btn-xs btn-default download-img" {dataKey} title="Скачать документ">
        <i class="glyphicon glyphicon-floppy-save"></i>
    </button>

        
    

HTML;
        

    ?>

    <?php

    	echo FileInput::widget([
    			'model' => $model,
    			'attribute' => 'img_file',
    			'options' => [
    				'multiple' => true,
    				'accept' => 'image/*',
    			],
    			'language' => 'ru',
    			'pluginOptions' => [

    				'uploadUrl' => Url::to(['inst/image-upload']),
    				'uploadExtraData' => [
    					'id_inst' => $id,
    				],
                    'previewZoomSettings' => [
                        'image' => ['width' => 'auto', 'height'=> '100%', 'max-height'=> '90%'],
                    ],
    				//'pweviewFileType' => 'image',
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
    				'browseLabel' => 'Выберите фото',
    				'dropZoneEnabled' => true,
    				//'maxImageWidth' => 100,
    				//'sortThumbs' => false,
    				//'autoReplace' => false,
    				//'initialPreviewShowDelete' => false,
                    'otherActionButtons' => $download,
    			]
    		]);
    	//echo '<span id="customCaption" class="text-success">No file selected</span>'

    ?>


		<?php

			$items = [
					/*[
						'url' => '/yii2-app-advanced/backend/web/images/1_b.jpg',
						'src' => '/yii2-app-advanced/backend/web/images/1_s.jpg',
						'options' => ['title' => 'LLS']
					],*/

			]




			?>

			<?= dosamigos\gallery\Gallery::widget(['items'=> $items])?>

	</div>
</div>

<?php
$script = <<<JS

$('.download-img').click(function(){
    var key = $(this).attr('data-key');
    var url = "/inst/download-img/"

    $('body').append('<a href="'+url+ key+'" style="display:none" id="clickk"></i></a>');
    document.getElementById('clickk').click();
    $('#clickk').remove();
});

JS;



$this->registerJs($script);


?>