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
        //print_r($items);
			//$items = [
					/*[
						'url' => '/yii2-app-advanced/backend/web/images/1_b.jpg',
						'src' => '/yii2-app-advanced/backend/web/images/1_s.jpg',
						'options' => ['title' => 'LLS']
					],*/

			//]




			?>

			<?= dosamigos\gallery\Gallery::widget(['items'=> $items])?>

	</div>
</div>

