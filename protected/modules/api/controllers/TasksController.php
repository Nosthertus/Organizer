<?php 

Class TasksController extends Controller
{
	// Do nothing on this request
	public function actionIndex()
	{
		Yii::app()->end();
	}

	/*
	*	Retrieve all tasks
	*/
	public function actionAll()
	{
		$tasks = Task::model()->findAllApi();

		echo CJSON::encode($tasks);
	}

	/*
	*	Retrieve the requested task
	*/
	public function actionView($id)
	{
		$task = Task::model()->findApi($id);

		echo CJSON::encode($task);
	}

	/*
	*	Create a new task
	*	code status: 0=invalid, 1=ok, 2=error
	*/
	public function actionCreate()
	{
		// Create a new instance of the model
		$model = new Task;

		// Instance of the status summary
		$summary = array(
			'status'=>null,
			'message'=>null,
			'error'=>null
		);

		if(isset($_POST['task']))
		{
			// Store all posted data in model's attributes
			$model->attributes = $_POST['task'];

			// Save the data
			if($model->save())
			{
				$summary['status'] = 1;
				$summary['message'] = 'Saved';
			}

			// Error on save
			else
			{
				$summary['status'] = 2;
				$summary['message'] = 'Error saving';
				$summary['error'] = $model->getErrors();
			}
		}

		// The post data is invalid
		else
		{
			$summary['status'] = 0;
			$summary['message'] = 'Data invalid';
		}

		echo CJSON::encode($summary);
	}
}