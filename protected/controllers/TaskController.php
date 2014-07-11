<?php
Class TaskController extends Controller
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
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionDelete($id)
	{
		if(isset($_POST['delete']))
		{
			$model = $this->loadModel($id);
			
			$redirect = $model->Project_id;

			$model->delete();

			echo $redirect;
		}
	}

	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Task');

		$this->layout = 'column2';

		$this->render('Index', array('dataProvider'=>$dataProvider));
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$_model = new Comment;

		$criteria = new CDbCriteria(array(
			'order'=>'id desc',
			'condition'=>'Task_id='.$id
		));

		$dataProvider = new CActiveDataProvider('Comment', array(
			'criteria'=>$criteria
		));

		if(isset($_POST['status']))
		{
			$model->Status = $_POST['status'];
			$model->save();
		}

		if(isset($_POST['Comment']))
		{
			$_model->attributes = $_POST['Comment'];
			$_model->Status = 1;
			$_model->Create_time = date('YmdHi');
			$_model->Author = Yii::app()->user->getId();
			$_model->Task_id = $id;

			if($_model->save())
			{
				$this->refresh();
			}
		}

		//Set change layout for the requester.
		if(Yii::app()->user->getId() == $model->user->id)
			$this->layout = 'column2';

		if($model->Assigned != '')
		{
			if($this->explodeByComma($model->Assigned))
			{
				if(in_array(Yii::app()->user->getId(), $this->explodeByComma($model->Assigned)))
					$this->layout = 'column2';
			}

			if($model->Assigned == Yii::app()->user->getId())
				$this->layout = 'column2';
		}

		$model->Tags = explode(',', $model->Tags);

		$this->render('view', array(
			'model'=>$model, 
			'dataProvider'=>$dataProvider,
			'_model'=>$_model
		));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if(isset($_POST['Task']))
		{
			$array = $_POST['Task']['Assigned'];

			if(is_array($array))
				$_POST['Task']['Assigned'] = implode(',', $array);

			$model->attributes = $_POST['Task'];
			$model->Tags = $this->removeSpace($model->Tags);
			$model->User_id = Yii::app()->user->getId();
			$model->Update_time = date('YmdHi');

			if($model->save())
				$this->redirect(array('/task/view', 'id'=>$model->id));
		}

		$model->Assigned = explode(',', $model->Assigned);

		$this->render('create', array(
			'model'=>$model
		));
	}

	public function actionCreate()
	{
		$model = new Task;

		if(isset($_POST['Task']))
		{
			if(isset($_POST['project']))
			{
				$array = $_POST['Task']['Assigned'];

				if(is_array($array))
				{
					$_POST['Task']['Assigned'] = implode(',', $array);
				}

				$model->attributes = $_POST['Task'];
				$model->Tags = $this->removeSpace($model->Tags);
				$model->Status = 1;
				$model->User_id = Yii::app()->user->getId();
				$model->Create_time = date('YmdHi');
				$model->Update_time = date('YmdHi');

				$tags = $model->Tags;

				$tags = explode(",", $tags);

				foreach($tags as $data)
				{
					if($data != '')
					{
						$record = Tags::model()->find(array(
							'select'=>'Name',
							'condition'=>'Name=:Name',
							'params'=>array(':Name'=>$data)
						));

						if($record === null)
						{
							$_model = new Tags;

							$_model->Name = $data;
							$_model->Frequency = 1;
							$_model->save();
						}

						else
						{
							$_model = Tags::model()->findByAttributes(array('Name'=>$data));

							$_model->Frequency = intval(Tags::model()->findByAttributes(array('Name'=>$data))->Frequency);
							$_model->Frequency += 1;
							$_model->save();
						}
					}
				}		

				if($model->save())
				{
					$this->redirect(array('/project/'.$_POST['project']));
				}
			}

			else
			{
				$array = $_POST['Task']['Assigned'];

				if(is_array($array))
				{
					$_POST['Task']['Assigned'] = implode(',', $array);
				}

				$model->attributes = $_POST['Task'];
				$model->Tags = $this->removeSpace($model->Tags);
				$model->Status = 1;
				$model->User_id = Yii::app()->user->getId();
				$model->Create_time = date('YmdHi');
				$model->Update_time = date('YmdHi');

				$tags = $model->Tags;

				$tags = explode(",", $tags);

				foreach($tags as $data)
				{
					if($data != '')
					{
						$record = Tags::model()->find(array(
							'select'=>'Name',
							'condition'=>'Name=:Name',
							'params'=>array(':Name'=>$data)
						));

						if($record === null)
						{
							$_model = new Tags;

							$_model->Name = $data;
							$_model->Frequency = 1;
							$_model->save();
						}

						else
						{
							$_model = Tags::model()->findByAttributes(array('Name'=>$data));

							$_model->Frequency = intval(Tags::model()->findByAttributes(array('Name'=>$data))->Frequency);
							$_model->Frequency += 1;
							$_model->save();
						}
					}
				}

				if($model->save())
				{
					$this->redirect(array('/Task'));
				}
			}
		}

		$this->render('create', array('model'=>$model));
	}

	public function actionSuggestTags()
	{
		if(isset($_GET['term']) && ($keyword=trim($_GET['term']))!=='')
		{
			$keyword = $this->removeSpace($keyword);
			$tags=Tags::model()->suggestTags($keyword);

			if($tags!==array())
				echo json_encode($tags);	
		}
	}

	public function loadModel($id)
	{
		$model = Task::model()->findByPk($id);

		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');

		else
			return $model;
	}
}
?>