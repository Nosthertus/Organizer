<?php

class DefaultController extends Controller
{
	//Do nothing on this request
	public function actionIndex()
	{
		Yii::app()->end();
	}

	public function actionLogin()
	{
		$model = new LoginForm;

		$summary = array(
			'Login'=>false,
			'message'=>'Supplied data is empty',
		);

		if(isset($_POST['username']) && isset($_POST['password']))
		{
			$model->attributes = $_POST;

			if($model->validate())
			{
				$summary['login'] = true;
				$summary['message'] = 'Login success';
			}

			if(!$model->validate())
			{
				$summary['login'] = false;
				$summary['message'] = 'Username or password is not valid';
			}
		}

		if(defined('YII_DEBUG'))
		{
			$summary['debug'] = array(
				'post'=>$_POST,
				'get'=>$_GET
			);
		}

		echo CJSON::encode($summary);
	}

	public function actionLogout()
	{
		$result = array(
			'result'=>null
		);

		// Check if the user is already logged in
		if(!Yii::app()->user->isGuest)
		{
			Yii::app()->user->logout();

			$result['result'] = true;
		}

		else
			$result['result'] = false;

		echo CJSON::encode($result);
	}
}