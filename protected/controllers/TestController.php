<?php

Class TestController extends Controller
{
	public function actionIndex()
	{
		if(isset($_POST['input']))
		{
			//Call fibonacci function.
			$fibonacci = $this->fibonacci($_POST['input']);

			$this->setFlash('test', $fibonacci);
		}
		
		$this->render('index');
	}

	//Execute fibonacci algorithm.
	private function fibonacci($value)
	{
		//Starting values.
		$data = array(0,1); #Array is good for better index location.

		/*
		* Calculate fibonacci.
		*
		* Do cycle by $value times.
		* Add array for each cycle with
		* value of the array length (count)
		* minus 2 (before last value of array)
		* plus value of the array lenght (count)
		* minus 1 (last value of array).
		*/
		for($i = 0; $i <= $value; $i++)
		{
			$data[] = $data[count($data) - 2] + $data[count($data) - 1];
		}

		//join all array values to string.
		$result = implode(',', $data);

		return $result;
	}

	private function setFlash($key, $value)
	{
		Yii::app()->user->setFlash($key, $value);
	}
}