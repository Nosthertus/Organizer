<?php 

Class UsersController extends Controller
{
	// Do nothing on this request
	public function actionIndex()
	{
		Yii::app()->end();
	}

	/*
	*	Retrieve all users
	*/
	public function actionAll()
	{
		$users = User::model()->findAllApi();

		echo CJSON::encode($users);
	}

	/*
	*	Retrieve the requested user
	*/
	public function actionView($id)
	{
		$user = User::model()->findApi($id);

		echo CJSON::encode($user);
	}

	/*
	*	Create a new user
	*	code status: 0=invalid, 1=ok, 2=error
	*/
	public function actionCreate()
	{
		// Create a new instance of the model
		$model = new User;

		// Instance of the status summary
		$summary = array(
			'status'=>null,
			'message'=>null,
			'error'=>null
		);

		if(isset($_POST['user']))
		{
			// Store all posted data in model's attributes
			$model->attributes = $_POST['user'];

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