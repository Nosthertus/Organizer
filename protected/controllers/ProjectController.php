<?php
Class ProjectController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete'
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate()
	{
		$model = new Project;

		if(isset($_POST['Project']))
		{
			$model->attributes = $_POST['Project'];
			$model->Creator = Yii::app()->user->getId();
			$model->Status = 0;

			if($model->save())
			{
				$this->redirect(array('/site/index'));
			}
		}

		$this->render('create', array('model'=>$model));
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$criteria = new CDbCriteria(array(
			'order'=>'id desc',
			'condition'=>'Project_id=:id',
			'params'=>array(':id'=>$id)
		));

		if(isset($_GET['user']))
			$criteria->addCondition('("," || Assigned || ",") LIKE "%,'.$_GET['user'].',%"');

		if(isset($_GET['status']))
			$criteria->addCondition('Status='.$_GET['status']);

		// $criteria = new CDbCriteria(array(
		// 	'order'=>'id desc',
		// 	'condition'=>'Project_id=:id AND ("," || Assigned || ",") LIKE "%,:userid,%"',
		// 	'params'=>array(':id'=>$id)
		// ));

		$dataProvider = new CActiveDataProvider('Task', array(
			'criteria'=>$criteria
		));

		$this->layout = 'column2';

		$this->render('view', array('model'=>$model, 'dataProvider'=>$dataProvider));
	}

	public function loadModel($id)
	{
		$model = Project::model()->findByPk($id);

		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');

		else
			return $model;
	}
}
?>