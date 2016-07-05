<?php

namespace backend\controllers;

use Yii;
use app\models\Auto;
use app\models\AutoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Inst;
use yii\helpers\Json;



/**
 * AutoController implements the CRUD actions for Auto model.
 */
class AutoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Auto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AutoSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        //Ajax update installer
        if(Yii::$app->request->post('hasEditable')){
            $instId = Yii::$app->request->post('editableKey');
            $inst = Inst::findOne($instId);

            $out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['Inst']);
            $post['Inst'] = $posted;
            if($inst->load($post)){
                $inst->save();
                $output = 'comment renew';
                $out = Json::encode(['output' => $output, 'message'=>'']);
            }
            echo $out;
            return;
        }



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Auto model.
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
     * Creates a new Auto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auto();

        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTs]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCreateAjax()
    {
        $model = new Auto();

        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()){
                Yii::$app->session->setFlash('kv-detail-success', 'Successful Update');
                echo 1;
            }else{
                echo 0;
            }
        } else {
            return $this->renderAjax('create-ajax', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Auto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTs]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Auto model.
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
     * Finds the Auto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
