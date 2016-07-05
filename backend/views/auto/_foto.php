<div class="panel panel-primary">
    <div class="panel-heading">
        <h>Фотогалерея</h>
    </div>
    <div class="panel-body">

		<?php

			$items = [
					[
						'url' => '/images/1_b.jpg',
						'src' => '/images/1_s.jpg',
						'options' => ['title' => 'LLS']
					],
					[
						'url' => '/images/2_b.jpg',
						'src' => '/images/2_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/3_b.jpg',
						'src' => '/images/3_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/4_b.jpg',
						'src' => '/images/4_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/5_b.jpg',
						'src' => '/images/5_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/6_b.jpg',
						'src' => '/images/6_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/1_b.jpg',
						'src' => '/images/1_s.jpg',
						'options' => ['title' => 'LLS']
					],
					[
						'url' => '/images/2_b.jpg',
						'src' => '/images/2_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/3_b.jpg',
						'src' => '/images/3_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/4_b.jpg',
						'src' => '/images/4_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/5_b.jpg',
						'src' => '/images/5_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/6_b.jpg',
						'src' => '/images/6_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/1_b.jpg',
						'src' => '/images/1_s.jpg',
						'options' => ['title' => 'LLS']
					],
					[
						'url' => '/images/2_b.jpg',
						'src' => '/images/2_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/3_b.jpg',
						'src' => '/images/3_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/4_b.jpg',
						'src' => '/images/4_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/5_b.jpg',
						'src' => '/images/5_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/6_b.jpg',
						'src' => '/images/6_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/1_b.jpg',
						'src' => '/images/1_s.jpg',
						'options' => ['title' => 'LLS']
					],
					[
						'url' => '/images/2_b.jpg',
						'src' => '/images/2_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/3_b.jpg',
						'src' => '/images/3_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/4_b.jpg',
						'src' => '/images/4_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/5_b.jpg',
						'src' => '/images/5_s.jpg',
						'options' => ['title' => 'LLS2']
					],
					[
						'url' => '/images/6_b.jpg',
						'src' => '/images/6_s.jpg',
						'options' => ['title' => 'LLS2']
					],

			]




			?>

			<?= dosamigos\gallery\Gallery::widget(['items'=> $items])?>

	</div>
</div>