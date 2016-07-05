<?php

namespace backend\controllers;
use yii;


class ReferenceController extends \yii\web\Controller
{
	public $layout = 'main-reference';
	public $item = true;

    public function actionIndex()
    {
    	//$this->layout = 'main-reference';
        return $this->render('index', ['item' => 'index']);
    }

    public function actionTest(){
    	Yii::$app->view->params['item'] = 'test';
    	return $this->render('test.php');
    }

    public function actionMarka(){
        
    }

}
