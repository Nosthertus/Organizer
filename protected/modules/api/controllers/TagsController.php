<?php 

Class TagsController extends Controller
{
	// Do nothing on this request
	public function actionIndex()
	{
		Yii::app()->end();
	}

	/*
	*	Retrieve all tags
	*/
	public function actionAll()
	{
		$tags = Tags::model()->findAllApi();

		echo CJSON::encode($tags);
	}

	/*
	*	Retrieve the requested tag
	*/
	public function actionView($id)
	{
		$tag = Tags::model()->findApi($id);

		echo CJSON::encode($tag);
	}

	/*
	*	Create a new tag
	*	code status: 0=invalid, 1=ok, 2=error
	*/
	public function actionCreate()
	{
		// Create a new instance of the model
		$model = new Tags;

		// Instance of the status summary
		$summary = array(
			'status'=>null,
			'message'=>null,
			'error'=>null
		);

		if(isset($_POST['tag']))
		{
			// Store all posted data in model's attributes
			$model->attributes = $_POST['tag'];

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