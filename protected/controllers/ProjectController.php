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
				//Check whenever modules are added in the form.
				if(isset($_POST['module']))
				{
					if($_POST['modules'] != 0)
					{
						$this->module($model, $_POST['Module']);

						$this->redirect(array('/site/index'));
					}

					Project::model()->findByPk($model->id)->delete();
					$model->addError('modules', 'Select number of modules.');
				}

				else
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

		$dataProvider = new CActiveDataProvider('Task', array(
			'criteria'=>$criteria
		));

		if(isset($_POST['module_id']))
		{
			if($_POST['module_id'])
				$criteria->addCondition('Module_id='.$_POST['module_id']);

			$this->widget('zii.widgets.ClistView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
				'template'=>"{items}\n{pager}",
				'emptyText'=>'No task for this project'
			));
			
			Yii::app()->end();
		}

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

	public function module($project, $modules)
	{
		foreach($modules as $data)
		{
			$_model = new Module;

			$_model->project_id = $project->id;
			$_model->name = $data['Name'];
			$_model->description = $data['Description'];
			$_model->status = 0;

			$_model->save();
		}
	}
}
?>