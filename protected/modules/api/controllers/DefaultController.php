<?php

class DefaultController extends Controller
{
	//Do nothing on this request
	public function actionIndex()
	{
		Yii::app()->end();
	}
}