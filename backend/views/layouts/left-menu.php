<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Pjax;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
?>


<div class="col-md-3">
<div id="navigation" class="list-group">
	
	<a class="list-group-item active" href="#navigation-10612" data-toggle="collapse" data-parent="navigation">Reference <b class="caret"></b></a>
	<div id="navigation-10612" class="submenu panel-collapse collapse in">
<?php
$type = 'info';
//var_dump($item); 
//$item = 'test';

	echo SideNav::widget([
			'type' => $type,
			'encodeLabels' => false,
			//'heading' => 'Reference',
			'items' => [
				['label' => 'Home', 'icon' => 'home', 'url' => Url::to(['/']), 'active'=> ($item == 'index')],
				['label'=>'Авто', 'icon'=>'list', 'items' => [
					['label' => 'Марка', 'url' => Url::to(['marka/']), 'active' => ($item == 'marka')],
					['label' => 'Модель', 'url' => Url::to(['model/']), 'active' => ($item == 'model')],
					['label' => 'Тип ТС', 'url' => Url::to(['typets/']), 'active' => ($item == 'typets')],
					['label' => 'Автомобиль', 'url' => Url::to(['auto/']), 'active' => ($item == 'auto')],
				]],
				['label' => 'Установщики', 'icon' => 'th', 'url' => Url::to(['installer/']), 'active'=> ($item == 'installer')],
				['label' => 'Статус', 'icon' => 'th', 'url' => Url::to(['col/']), 'active'=> ($item == 'col')],
				['label' => 'СИМ-карты', 'icon' => 'th', 'url' => Url::to(['sim/']), 'active'=> ($item == 'sim')],
				['label'=>'УТГ', 'icon'=>'list', 'items' => [
					['label' => 'Филиал', 'url' => Url::to(['fil/']), 'active' => ($item == 'fil')],
					['label' => 'Подразделение', 'url' => Url::to(['pod/']), 'active' => ($item == 'pod')],
				]],
			]

		])

?>
	</div>

</div>
<!-- <div id="navigation" class="list-group">
	
	<a class="list-group-item active" href="#navigation-10612" data-toggle="collapse" data-parent="navigation">Reference <b class="caret"></b></a>
	<div id="navigation-10612" class="submenu panel-collapse collapse in">
		<a class="list-group-item" href="unit/create">Блоки</a>
		<?= Html::a('Блоки', ['test'], ['class' => 'list-group-item'])?>
	</div>

</div> -->



	<?php



	/*NavBar::begin([]);
		echo Nav::widget([
				'items' => [
					['label' =>'Home', 'url' => ['site/index']],
					['label' =>'Menu2', 'url' => ['site/index']],
					['label' =>'Menu3', 'url' => ['unit/index'], 'items'=>[
						['label' =>'Menu3.1', 'url' => ['unit/index', 'tag' => 'new']],
						['label' =>'Menu3.2', 'url' => ['unit/index', 'tag' => 'popular']],
					]],
				],
				'options' => ['class' => 'navigationr']
			]);
	NavBar::end();*/
		



		/*echo Menu::widget([
				'items' => [
					['label' =>'Home', 'url' => ['site/index']],
					['label' =>'Menu2', 'url' => ['site/index']],
					['label' =>'Menu3', 'url' => ['unit/index'], 'items'=>[
						['label' =>'Menu3.1', 'url' => ['unit/index', 'tag' => 'new']],
						['label' =>'Menu3.2', 'url' => ['unit/index', 'tag' => 'popular']],
					]],
				],
				'options' => ['class' => 'sidebar-menu']
			])*/

	?>
</div>
