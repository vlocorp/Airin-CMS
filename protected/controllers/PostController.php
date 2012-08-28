<?php

Yii::import('ext.vlo.upload.VUpload');

class PostController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'getSubCategoryOptions'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'uploadRedactor'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Post;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            $VUpload = new VUpload();
            $VUpload->path = 'images/post/';
            $VUpload->doUpload($model, 'image');

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        //creating category
        $this->createCategory();
        
        //creating sub category
        $this->createSubCategory();
        
        $this->render('create', array(
            'model' => $model,            
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            $VUpload = new VUpload();
            $VUpload->path = 'images/post/';
            $VUpload->doUpload($model, 'image');
            
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Post');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Post('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Post']))
            $model->attributes = $_GET['Post'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Post::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * dropDownList for category form     
     */
    protected function getCategoryOptions() {        
        return CHtml::listData(Category::model()->findAll(), 'id', 'name');
    }


    /**
     * dropDownList for active form     
     */
    protected function getActiveOptions() {
        return array(
            '1' => 'Yes',
            '0' => 'No',
        );
    }

    /**
     * dropDownList for hot form     
     */
    protected function getHotOptions() {
        return array(
            '0' => 'No',
            '1' => 'Yes',
        );
    }

    /**
     * AJAX dropdownList get sub category list data
     */
    public function actionGetSubCategoryOptions() {
        $category_id = $_POST['category_id'];
        $model = SubCategory::model()->findAllByAttributes(array(
            'category_id' => $category_id
                ));
                
        $option = array(''=>'Set Null');
        $options = CHtml::listData($model, 'id', 'name');        
        $options = CMap::mergeArray($option, $options);        
        echo json_encode($options);
    }
    
    public function actionUploadRedactor($get = null, $type = null) {
        Yii::import('ext.vlo.redactorjs.Redactor');
        $redactor = new Redactor();

        //if get true, then get file to render at editor, else upload the file
        if ($get)
            $redactor->getFile();
        else {
            //set path by it's type
            if ($type == 'image') {
                $redactor->setPath('images/post'); //set image path here
                $redactor->uploadImage();
            } else {
                $redactor->setPath('files/post'); //set file path here
                $redactor->uploadFile();
            }
        }
    }
    
    /**
     * dialog createCategory
     * @return \Category
     */
    public function createCategory(){
        $model = new Category;
        
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
        if(isset($_POST['Category'])){
            $model->attributes = $_POST['Category'];
            
            if($model->save())
                $this->redirect(array('post/create'));            
        }
        return $model;
    }
    
    /**
     * dialog createSubCategory
     * @return \Category
     */
    public function createSubCategory(){
        $model = new SubCategory;
        
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sub-category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
        if(isset($_POST['SubCategory'])){
            $model->attributes = $_POST['SubCategory'];
            
            if($model->save())
                $this->redirect(array('post/create'));            
        }
        return $model;
    }

}
