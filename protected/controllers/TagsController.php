<?php

class TagsController extends Controller
{
	public function actionIndex()
	{
		$model = Tags::model()->findAll(array('select'=>'Name,Frequency'));

		$this->render('index', array(
			'model'=>$model
		));
	}

	public function actionSearch()
	{
		if(isset($_GET['tag']))
		{
			$criteria = new CdbCriteria(array(
				'condition'=>'("," || Tags || ",") LIKE "%,'.$_GET['tag'].',%"'
			));

			if(isset($_GET['user']))
				$criteria->addCondition('("," || Assigned || ",") LIKE "%,'.$_GET['user'].',%"');

			if(isset($_GET['status']))
				$criteria->addCondition('Status='.$_GET['status']);

			$dataProvider = new CActiveDataProvider('Task', array(
				'criteria'=>$criteria
			));

			$this->render('search', array(
				'dataProvider'=>$dataProvider
			));
		}

		else
			throw new CHttpException(400, 'Bad Request');
	}
}