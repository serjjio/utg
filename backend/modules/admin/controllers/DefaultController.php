<?php

namespace backend\modules\admin\controllers;

use yii;
use yii\web\Controller;
use yii\filters\AccessControl;


/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','test'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest(){
    	//Yii::$app->view->params['item'] = 'test';
    	return $this->render('test.php');
    }
}
