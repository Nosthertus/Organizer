<?php 

Class ModulesController extends Controller
{
	// Do nothing on this request
	public function actionIndex()
	{
		Yii::app()->end();
	}

	/*
	*	Retrieve all modules
	*/
	public function actionAll()
	{
		$modules = Module::model()->findAllApi();

		echo CJSON::encode($modules);
	}

	/*
	*	Retrieve the requested module
	*/
	public function actionView($id)
	{
		$module = Module::model()->findApi($id);

		echo CJSON::encode($module);
	}

	/*
	*	Create a new module
	*	code status: 0=invalid, 1=ok, 2=error
	*/
	public function actionCreate()
	{
		// Create a new instance of the model
		$model = new Module;

		// Instance of the status summary
		$summary = array(
			'status'=>null,
			'message'=>null,
			'error'=>null
		);

		if(isset($_POST['module']))
		{
			// Store all posted data in model's attributes
			$model->attributes = $_POST['module'];

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