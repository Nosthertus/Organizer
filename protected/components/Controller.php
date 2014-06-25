<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function Init()
	{
		date_default_timezone_set('America/Caracas');

		$model = Track::model()->find(array(
			'select'=>'session',
			'condition'=>'session=:session',
			'params'=>array(':session'=>Yii::app()->session->sessionID)
		));

		if(!$model)
		{
			if(Yii::app()->user->isGuest)
			{
				$_model = new Track;

				$_model->session = yii::app()->session->sessionID;
				$_model->date = date('Y-m-d');
				$_model->time = date('H:i');
				$_model->ip = $_SERVER['REMOTE_ADDR'];
				$_model->save();
				
				echo 'Tracking';
			}
		}

		parent::init();
	}

	public function status($status)
	{
		$status = intval($status);

		if($status == 1)
			return '<span class="label label-primary">Pending</span>';

		if($status == 2)
			return '<span class="label label-success">Finished</span>';

		if($status == 3)
			return '<span class="label label-info">In Progress</span>';

		else
			return '<span class="label label-danger">Danger</span>';
	}

	public function explodeByComma($data)
	{
		if(strpos($data, ',') !== false)
		{
			$array = explode(',', $data);

			return $array;
		}

		else
			return false;
	}

	public function removeSpace($that)
	{
		if(is_array($that))
		{
			$array = array();
			foreach($that as $data)
				$array[] = str_replace(' ', '', $data);

			return $array;
		}

		else
		{
			$that = str_replace(' ', '', $that);

			return $that;
		}
	}
	
	public function array_sort($array, $on, $order=SORT_ASC)
	{
		$new_array = array();
		$sortable_array = array();

		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}

			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}

			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}

		return $new_array;
	}
}