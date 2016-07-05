<?php

namespace backend\controllers;

use Yii;
use app\models\Inst;
use app\models\Auto;
use app\models\Pod;
use app\models\Img;
use app\models\Doc;
use app\models\Model;
use app\models\Marka;
use app\models\Unit;
use app\models\InstSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\filters\AccessControl;
use yii\helpers\Html;



/**
 * InstController implements the CRUD actions for Inst model.
 */
class InstController extends Controller
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
                    /*[
                        'actions' => ['foto'],
                        'allow' => true,
                    ],*/
                    [
                        'actions' => ['index', 'create', 'file-delete', 'file', 'slide', 'image-upload', 'foto', 'update', 'view', 'doc-upload', 'doc-delete', 'download', 'download-doc', 'download-img', 'change-fil', 'change-marka', 'inactive', 'inst-detail', 'test'],
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
     * Lists all Inst models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->language = 'ru-RU';
        ini_set('memory_limit', '-1');
        $searchModel = new InstSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        



        if(Yii::$app->request->post('hasEditable')){

            $instId = Yii::$app->request->post('editableKey');
           
            $inst = Inst::findOne($instId);

            $out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['Inst']);

            $post['Inst'] = $posted;
            /*var_dump($post);
            exit;*/
            if($inst->load($post)){
                $inst->save();
                $output = 'record update';
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
     * Displays a single Inst model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
           
            //$post = Yii::$app->request->post();
            //$out = Json::encode(['output'=>'','message'=>'']);
            //$posted = current($_POST['Inst']);
            
            //$inst->load($post);
            $model->save();
            //$out = Json::encode(['success' =>true, 'message'=>['kv-detail-info'=> 'Success']]);
            //Yii::$app->session->setFlash('kv-detail-success', 'Установка успешно изменена!');
            //return $this->redirect(['view', 'id'=>$inst->ID]);
            //return;
            //echo $out;
            //Yii:$app->response->redirect(['login']);
            //var_dump("HELLO");
            //Yii::$app->response->getHeaders()->add('X-PJAX-Url', Yii::$app->request->referrer);
            //Yii::$app->response->redirect(['inst']);
        }else{
            
            $modelAuto = Auto::findOne($model->idAuto);
            

            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
                'modelAuto' => $modelAuto,

            ]);
        }   
    }

    /**
     * Creates a new Inst model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTest($id){
        
            $model = $this->findModel($id);
            return $this->render('_auto', ['model' => $model]);
        
         
    }
    public function actionInstDetail(){
        if (isset($_POST['expandRowKey'])){
            $model = $this->findModel($_POST['expandRowKey']);
            $modelAuto = Auto::findOne($model->idAuto);
            $modelUnit = Unit::findOne($model->blok);
            return $this->renderAjax('_auto', ['model' => $model, 'modelAuto' => $modelAuto, 'modelUnit' => $modelUnit]);
        }else{
            return '<div class="alert alert-danger">No data found</div>';
        }
    }


    public function actionCreate()
    {
        Yii::$app->language = 'ru-RU';
        $model = new Inst();
        $modelAuto = new Auto();
        
        if ($model->load(Yii::$app->request->post()) && $modelAuto->load(Yii::$app->request->post())) {
            $modelAuto->save();
            $date= strtotime($model->date);
            $model->idAuto = $modelAuto->idTs;
            $model->date = date('Y-m-d', $date);
            $model->id_fil = $modelAuto->fil;
            $model->id_pod = $modelAuto->pod;
            $model->save();
            
            Yii::$app->session->setFlash('kv-detail-success', 'Successful Create Inst');
            
            Yii::$app->response->redirect(['inst']);
        } else {
            $model->date = date('d-M-Y');
            return $this->render('create', [
                'model' => $model,
                'modelAuto' => $modelAuto,
            ]);
        }
    }
    public function actionChangeMarka($id){

        $countModel = Model::find()
                        ->where(['id_marka' => $id])
                        ->count();
        $models = Model::find()
                    ->where(['id_marka' => $id])
                    ->all();
        if ($countModel > 0){
            foreach ($models as $model){
                echo "<option value = '".$model->idmodel."'>".$model->name_model."</option>";
            }
        }else{
            echo "<option></option>";
        }
    }
    public function actionChangeFil($id){
        $countPod = Pod::find()
                        ->where(['idFil' => $id])
                        ->count();
        $pods = Pod::find()
                    ->where(['idFil'=> $id])
                    ->all();
        if ($countPod > 0){
            foreach($pods as $pod){
                echo "<option value='".$pod->idpod."'>".$pod->podcol."</option>";
            }
        }else{
            echo "<option> - </option>";
        }
    }

    /**
     * Updates an existing Inst model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        Yii::$app->language = 'ru-RU';
        
        $model = $this->findModel($id);

        $modelAuto = Auto::findOne($model->idAuto);

        if ($model->load(Yii::$app->request->post()) && $modelAuto->load(Yii::$app->request->post())) {
            $modelAuto->save();
            $date= strtotime($model->date);
            $model->idAuto = $modelAuto->idTs;
            $model->date = date('Y-m-d', $date);
            $model->id_fil = $modelAuto->fil;
            $model->id_pod = $modelAuto->pod;
            if ($model->save()){
                echo 1;
            }else{
                echo 0;
            }
            
            //Yii::$app->session->setFlash('kv-detail-success', 'Successful Create Inst');
            
            //Yii::$app->response->redirect(['inst']);
        } else {
            $model->date = date('d-m-Y');
            return $this->renderAjax('_form-update', [
                'model' => $model,
                'modelAuto' => $modelAuto,
            ]);
        }
    }

    /**
     * Deletes an existing Inst model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionInactive()
    {
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isAjax && isset($post)){
            $id = $_POST['id'];
            $model = $this->findModel($id);
            $model->active = 0;
            if($model->save()){
                echo Json::encode([
                        'success' => true,
                        'messages' => [
                            'kv-detail-info' => 'Установка успешно удалена. ' .
                            Html::a('<i class="glyphicon glyphicon-hand-right"></i> Нажмите', ['/inst'],
                                ['class' => 'btn btn-sm btn-info']
                             )
                        ]
                    ]);
                return;
            }else{
                echo Json::encode([
                        'success' => false,
                        'messages' => [
                            'kv-detail-info' => 'Установка не может быть удалена. Свяжитесь с администратором ' .
                            Html::a('<i class="glyphicon glyphicon-hand-right"></i> Нажмите', ['/inst'],
                                ['class' => 'btn btn-sm btn-info']
                             )
                        ]
                    ]);
                return;
            }
            
        }else{
                throw new InvalidCallException("You are not allowed ro do this operation. Contact the administrator");
            }
        //$this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the Inst model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inst the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inst::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFoto($id){
        
        $countImages = Img::find()
                    ->where(['id_inst' => $id])
                    ->count();

        if ($countImages == 0){
            $model = new Img();
            $model->id_inst = $id;
            $dropZone = false;
            $initialPreview = [];
            $initialPreviewConfig=[];
        }else{
            $model = new Img();
            $images = Img::find()
                            ->where(['id_inst' => $id])
                            ->all();
            $dropZone = true;
            foreach($images as $image){
                $initialPreview[] = $image->img_big;
                $explod = explode("/", $image->img_big);
                $name = array_pop($explod);
                $initialPreviewConfig[] = ['caption' => $name, 'size' => $image->size, 'url' => '/inst/file-delete', 'key'=>$image->idimg];
  
            }
        }

       //$initialPreview = array();
                
            return $this->render('foto',[
                    'model' => $model,
                    //'images' => $images,
                    'id' => $id,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig

                ]);
        
    }

    public function actionImageUpload(){
            
            $model = new Img();

            if(Yii::$app->request->isPost){
                $model->img_file= UploadedFile::getInstance($model, 'img_file');
                //$small_img = UploadedFile::getInstance($model, 'img_file');
                
                if ($model->img_file == NULL){
                    return true;
                }else{

                $fileName = uniqid();
                $folder_name = $_POST['id_inst'];
                if(!is_dir(Yii::getAlias('@webroot').'/images/'.$folder_name)){
                        mkdir(Yii::getAlias('@webroot').'/images/'.$folder_name);
                        chmod(Yii::getAlias('@webroot').'/images/'.$folder_name, 0777);
                    };
               

                //save big image in dir
                    $model->img_file->saveAs(Yii::getAlias('@webroot'.'/images/'.$folder_name.'/'.$model->img_file->baseName.'.'.$model->img_file->extension));
                    
                //save small image(90x90)
                Image::thumbnail('@webroot/images/'.$folder_name.'/'.$model->img_file->baseName.'.'.$model->img_file->extension,90, 90)->save(Yii::getAlias('@webroot'.'/images/'.$folder_name.'/'.$model->img_file->baseName.'_s.'.$model->img_file->extension), ['quality' => 100]);


                $size = $model->img_file->size;
                
                //save in DB
                $model->id_inst = $folder_name;
                $model->img_big = '/images/'.$folder_name.'/'.$model->img_file->baseName.'.'.$model->img_file->extension;
                $model->img_small = '/images/'.$folder_name.'/'.$model->img_file->baseName.'_s.'.$model->img_file->extension;
                $model->size = "$size";
                
                $model->img_file = NULL;
        
            }

            $model->save();

            return true;
            }
    }

    public function actionFileDelete(){
        
        if(Yii::$app->request->isPost){
        $model = Img::findOne($_POST['key'])->delete();
        return true;
        }

    }

    public function actionSlide($id){

        $countImages = Img::find()
                        ->where(['id_inst'=>$id])
                        ->count();
        $images = Img::find()
                        ->where(['id_inst'=>$id])
                        ->all();
        if($countImages > 0){
            //$items = array();
            foreach($images as $image){
                $explod = explode("/", $image->img_big);
                $name = array_pop($explod);
                $items[]= [
                    'url' => $image->img_big,
                    'src' => $image->img_small,
                    'options' => ['title' => $name]
                ];
            }

        }else{
            $items = [];
        }

        return $this->render('slide',[
                'items' => $items
            ]);
    }

    public function actionFile($id){

        $countDoc = Doc::find()
                    ->where(['id_inst' => $id])
                    ->count();

        if ($countDoc == 0){
            $model = new Doc();
            $model->id_inst = $id;
            $initialPreview = [];
            $initialPreviewConfig=[];
        }else{
            $model = new Doc();
            $docs =Doc::find()
                            ->where(['id_inst' => $id])
                            ->all();

            foreach($docs as $doc){
                $explode = explode(".", $doc->doc_name);
                $type = array_pop($explode);
                
                if ($type == 'jpg' || $type =='png' || $type=='bmp'){
                    $initialPreview[] = '/docs/'.$id.'/'.$doc->doc_name;
                    $initialPreviewConfig[] = ['caption' => $doc->doc_name, 'size' => $doc->size, 'url' => '/inst/doc-delete', 'key' => $doc->iddoc,];
                }elseif($type == 'docx'){

                    $initialPreview[] = '/docs/docs.png';

                    $initialPreviewConfig[] = [
                            //'type' => 'other',
                            'caption' => $doc->doc_name, 
                            'size' => $doc->size, 
                            'url' => '/inst/doc-delete',
                            //'download' => Html::a("cssc", ['create'])
                            'key' => $doc->iddoc,
                            
                            
                            'data-key' => '100',
                            'previewAsDate' => true,
                            'zoom' => false,
                    ];
                }elseif($type == 'zip'){
                    $initialPreview[] = '/docs/Zip-icon.png';
                    $initialPreviewConfig[] = ['caption' => $doc->doc_name, 'size' => $doc->size, 'url' => '/inst/doc-delete', 'key' => $doc->iddoc,];
                }elseif($type == 'txt'){
                    $file = Yii::getAlias('@webroot').'/docs/'.$id.'/'.$doc->doc_name;
                    $text = utf8_encode(file_get_contents($file));
                    $initialPreview[] = $text;
                    $initialPreviewConfig[] = ['type' => 'text', 'caption' => $doc->doc_name, 'size' => $doc->size, 'url' => '/inst/doc-delete', 'key' => $doc->iddoc,];
                }else{
                    $initialPreview[] = '/docs/'.$id.'/'.$doc->doc_name;
                    $initialPreviewConfig[] = ['type' => $type, 'caption' => $doc->doc_name, 'size' => $doc->size, 'url' => '/inst/doc-delete', 'key' => $doc->iddoc,];
                }
  
            }
        }

       //$initialPreview = array();
                
            return $this->render('document',[
                    'model' => $model,
                    //'images' => $images,
                    'id' => $id,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig

                ]);

    }

    public function actionDocUpload(){  
        $model = new Doc;

        if(Yii::$app->request->isPost){
            $model->doc_file = UploadedFile::getInstance($model, 'doc_file');
            if($model->doc_file == NULL){
                return true;
            }else{
                $folder_name = $_POST['id_inst'];
                if(!is_dir(Yii::getAlias('@webroot').'/docs/'.$folder_name)){
                        mkdir(Yii::getAlias('@webroot').'/docs/'.$folder_name);
                        chmod(Yii::getAlias('@webroot').'/docs/'.$folder_name, 0777);
                    };
                $size = $model->doc_file->size;

                $model->doc_name = $model->doc_file->baseName.'.'.$model->doc_file->extension;
                $model->id_inst = $folder_name;
                $model->size = "$size";

                if($model->save()){
                    $model->doc_file->saveAs(Yii::getAlias('@webroot').'/docs/'.$folder_name.'/'.$model->doc_file->baseName.'.'.$model->doc_file->extension);
  

                    $model->doc_file = NULL;

                    return TRUE;

                }else{
                    echo "Error save in DB";
                }


                

                
            }
        }
    }

    public function actionDocDelete(){
        //var_dump($_POST);
        if(Yii::$app->request->isPost){
            $model = Doc::findOne($_POST['key'])->delete();
            return true;
        }
    }

    /*public function actionDoc($id){
        if(Yii::$app->request->isGet){
            $model = Doc::findOne($id);
            $file = Yii::getAlias('@webroot').'/docs/'.$model->id_inst.'/'.$model->doc_name;
            if(file_exists($file)){
                return Yii::$app->response->sendFile($file);
            }
        }
    }*/

    public function actionDownloadDoc($id){
        
            //$id = $_POST['key'];
            $model = Doc::findOne($id);
            $file = Yii::getAlias('@webroot').'/docs/'.$model->id_inst.'/'.$model->doc_name;
            if(file_exists($file)){
                //return '../../docs/'.$model->id_inst.'/'.$model->doc_name;
                //return $file;
                return Yii::$app->response->sendFile($file);

                /*if(ob_get_level()){
                    ob_end_clean();
                }
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.$model->doc_name);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Lenght: '.$model->size);
                readfile($file);
                exit;*/
            }
        
    }
    public function actionDownloadImg($id){
        $model = Img::findOne($id);
        
        
        $file = Yii::getAlias('@webroot').$model->img_big;
        if(file_exists($file)){
            return Yii::$app->response->sendFile($file);
        }else{
            throw new NotFoundHttpException('Page not found.');
        }
    }
     
}
