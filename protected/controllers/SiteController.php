<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->renderPartial('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/*
	* Displays the register page
	*/
	public function actionRegister()
	{
		$model = new User;

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			$data = User::model()->find(array(
				'condition'=>'username=:user',
				'params'=>array('user'=>$model->username)
			));

			if(!$data)
			{
				$model->password=$model->hashPassword($_POST['User']['password'],$session=$model->generateSalt());
				$model->session=$session;

				if($model->save())
				{
					$this->redirect(array('login'));
				}
			}

			else
			{
				$model->addError('username', 'User already exists');
			}
		}
		
		$this->render('register', array('model'=>$model));
	}

	/*
	* Displays the chat page
	*/
	public function actionChat()
	{
		if(!Yii::app()->user->isGuest)
		{
			$this->renderPartial('chat');
		}

		else
			throw new CHttpException(401, 'You are not Authorized');
	}

	/*
	* Display a list of all Tags
	*/
	public function actionTags()
	{
		$model = Tags::model()->findAll(array('select'=>'Name'));
		$this->render('Tags', array(
			'model'=>$model
		));
	}

	public function actionExport()
	{
		$sqlite = array();
		$sqlite[]['comment'] = Comment::model()->findAll();
		$sqlite[0]['tableName'] = 'comment';
		$sqlite[]['project'] = Project::model()->findAll();
		$sqlite[1]['tableName'] = 'project';
		$sqlite[]['projectType'] = ProjectType::model()->findAll();
		$sqlite[2]['tableName'] = 'projectType';
		$sqlite[]['tags'] = Tags::model()->findAll();
		$sqlite[3]['tableName'] = 'tags';
		$sqlite[]['task'] = Task::model()->findAll();
		$sqlite[4]['tableName'] = 'task';
		$sqlite[]['user'] = User::model()->findAll();
		$sqlite[5]['tableName'] = 'user';

		$mysql = array();
		$mysql['comment'] = null;
		$mysql['project'] = null;
		$mysql['projectType'] = null;
		$mysql['tags'] = null;
		$mysql['task'] = null;
		$mysql['user'] = null;

		$tab = null;
		$column = null;

		foreach($sqlite as $table)
		{
			$tableName = $table['tableName'];
			unset($table['tableName']);

			foreach($table as $column)
			{
				foreach($column as $data)
				{
					unset($data['id']);
					$mysql[$tableName][] = $data->attributes;	
				}
			}
		}

		if(file_put_contents('C:/json.txt', json_encode($mysql)))
			echo 'saved';

		else
			echo 'error';

	}
}