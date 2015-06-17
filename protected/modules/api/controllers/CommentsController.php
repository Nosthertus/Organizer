<?php 

Class CommentsController extends Controller
{
	// Do nothing on this request
	public function actionIndex()
	{
		Yii::app()->end();
	}

	/*
	*	Retrieve all coments
	*/
	public function actionAll()
	{
		$coments = Comment::model()->findAllApi();

		echo CJSON::encode($coments);
	}

	/*
	*	Retrieve the requested comment
	*/
	public function actionView($id)
	{
		$comment = Comment::model()->findApi($id);

		echo CJSON::encode($comment);
	}

	/*
	*	Create a new comment
	*	code status: 0=invalid, 1=ok, 2=error
	*/
	public function actionCreate()
	{
		// Create a new instance of the model
		$model = new Comment;

		// Instance of the status summary
		$summary = array(
			'status'=>null,
			'message'=>null,
			'error'=>null
		);

		if(isset($_POST['comment']))
		{
			// Store all posted data in model's attributes
			$model->attributes = $_POST['comment'];

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