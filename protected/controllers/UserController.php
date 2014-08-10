<?php 

class UserController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$this->render('view', array(
			'model'=>$model
		));
	}

	private function loadModel($id)
	{
		$model = User::model()->findByPk($id);

		if($model === null)
			throw new CHttpException(404, 'the requested page does not exist.');

		return $model;
	}

}