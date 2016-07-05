<?php

namespace backend\controllers;

use Yii;
use app\models\Unit;
use app\models\Sim;
use app\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * UnitController implements the CRUD actions for Unit model.
 */
class UnitController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => ['index','view', 'create', 'get-icc', 'sim-list', 'add-sim', 'update', 'delete', 'test' ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Unit models.
     * @return mixed
     */
    public function actionTest(){
        //for($i=0; $i<=15; $i++){
            $file = file_get_contents('http://www.vsegost.com/Data/532/53254/0.gif');
            //file_put_contents(Yii::getAlias('@webroot').'/images/7816-9-2011/'.$i.'.gif', $file);
            $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE,
                    'content' => $file,
                ]);
            return $pdf->render();
        //}
    }

    public function actionIndex()
    {
        
        Yii::$app->language = 'ru-RU';
        ini_set('memory_limit', '-1');

        /*if(Yii::$app->request->getHeaders()->has('X-PJAX')){

        }*/
        /*if(Yii::$app->request->post()){
            var_dump(Yii::$app->request->post());
        }*/
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           
        ]);
    }

    /**
     * Displays a single Unit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Unit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $modelUnit = new Unit();
        

        if ($modelUnit->load(Yii::$app->request->post())) {

            $modelUnit->idICC = $modelUnit->idSim;
                
            $modelUnit->save();
           

            Yii::$app->session->setFlash('kv-detail-success', 'Объект успешно создан!');
            return $this->redirect(Yii::$app->request->referrer);
         
        }else {
            return $this->renderAjax('create', [
                'modelUnit' => $modelUnit,
                
            ]);
        }

    }

    public function actionGetIcc($id){
        $ICC = Sim::find()
                        ->where(['id' => $id])
                        ->one();
        if($ICC){
            echo $ICC->icc;
        }else
            echo "";
    }

    public function actionSimList($q = null, $id = null){

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $out = ['results' => ['id' => '', 'text' => '']];
        if(!is_null($q)){

            $query = new Query;
            $query->select(['id AS id', 'SIM AS text'])
                    ->from('sim')
                    ->where(['like', 'SIM', $q])
                    ->limit(50);
            $command = $query->createCommand();
            $data = $command->queryAll();
            //var_dump($id);
            //exit;
            $out['results'] = array_values($data);
            //var_dump($out);
            //exit;
            
        }
        elseif ($id > 0){
            
            $out['results'] = ['id' => $id, 'text' => Sim::find($id)->SIM];
        }
       
        return $out;
    }

    public function actionAddSim(){
        if(Yii::$app->request->post()){
            $model = new Sim;

            $sim = $_POST['sim'];
            $icc = $_POST['icc'];

            $model->SIM = $sim;
            $model->icc = $icc;
            if($model->save()){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    /**
     * Updates an existing Unit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelUnit = $this->findModel($id);

        if ($modelUnit->load(Yii::$app->request->post())) {

            $modelUnit->idICC = $modelUnit->idSim;
                
            $modelUnit->save();

            return $this->redirect(Yii::$app->request->referrer);
            //return $this->redirect(['view', 'id' => $modelUnit->blok]);
        } else {
            return $this->renderAjax('update', [
                'modelUnit' => $modelUnit,
            ]);
        }
    }

    /**
     * Deletes an existing Unit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Unit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Unit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Unit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
