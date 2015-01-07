<?php

class CategoryController extends Controller{
    
    /* Макет */
    public $layout='//layouts/column2';
    
    /**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
    
    /* Права */
    public function accessRules(){
    return array(
        array('allow',  // позволим всем пользователям выполнять действия 'list' и 'show'
            'actions'=>array('index', 'view'),
            'users'=>array('*'),
        ),
        array('allow', // позволим аутентифицированным пользователям выполнять любые действия
            'users'=>array('@'),
        ),
        array('deny',  // остальным запретим всё
            'users'=>array('*'),
        ),
    );
    }
    
    /* Вью, просто вью */
    public function actionView(){
    $сategory=$this->loadModel();
    //$comment=$this->newComment($сategory);
 
    $this->render('view',array(
        'model'=>$сategory,
        //'comment'=>$comment,
    ));
    }
    
    /* Создание категории */
    public function actionCreate(){
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    
    /* Редактирование категорий */
    public function actionUpdate($id){
		$model=$this->loadModelId($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save()){
			 $this->redirect(array('view','id'=>$model->id));
			}	
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    
    /* Удаление категорий */
    public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModelId()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
    public function actionIndex(){
    $criteria=new CDbCriteria(array(
        'order'=>'update_time DESC'
    ));
    if(isset($_GET['tag']))
        $criteria->addSearchCondition('tags',$_GET['tag']);
 
    $dataProvider=new CActiveDataProvider('Category', array(
            'pagination'=>array(
            'pageSize'=>5,
        ),
    ));
 
    $this->render('index',array(
        'dataProvider'=>$dataProvider,
    ));
    }
    
    /* Админка */
    public function actionAdmin(){
		$model=new Category('search');
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    
    /* Выборка модели по ид категории */
    public function loadModel(){
    if($this->_model===null)
    {
        if(isset($_GET['id']))
        {
            $criteria=new CDbCriteria;
            if(Yii::app()->user->isGuest){
                $criteria->condition = 'id_cat=:id_cat AND status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
            }else{
                $criteria->condition = 'id_cat=:id_cat';
            }
            $criteria->order = 'id DESC';
            $criteria->params = array(':id_cat'=>$_GET['id']);
            $this->_model=Post::model()->findAll($criteria);
        }
        if($this->_model===null)
            throw new CHttpException(404,'Запрашиваемая страница не существует!!!.');
    }
    return $this->_model;
    }
    
    /* Выборка модели по ид */
    public function loadModelId(){
        
        if($this->_model===null){
            if(isset($_GET['id'])){
                $this->_model=Category::model()->findByPk($_GET['id']);
            }
            if($this->_model===null)
                throw new CHttpException(404,'Запрашиваемая страница не существует!!!.');
        }
        return $this->_model;
        }
    


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}