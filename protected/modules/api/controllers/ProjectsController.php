<?php 

Class ProjectsController extends Controller
{
	// Do nothing on this request
	public function actionIndex()
	{
		Yii::app()->end();
	}

	/*
	*	Retrieve all projects
	*/
	public function actionAll()
	{
		$projects = Project::model()->findAllApi();

		echo CJSON::encode($projects);
	}

	/*
	*	Retrieve the requested project
	*/
	public function actionView($id)
	{
		$project = Project::model()->findApi($id);

		echo CJSON::encode($project);
	}

	/*
	*	Create a new project
	*	code status: 0=invalid, 1=ok, 2=error
	*/
	public function actionCreate()
	{
		// Create a new instance of the model
		$model = new Project;

		// Instance of the status summary
		$summary = array(
			'status'=>null,
			'message'=>null,
			'error'=>null
		);

		if(isset($_POST['project']))
		{
			// Store all posted data in model's attributes
			$model->attributes = $_POST['project'];

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