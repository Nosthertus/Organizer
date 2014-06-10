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
}