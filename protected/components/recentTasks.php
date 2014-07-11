<?php

Yii::import('zii.widgets.CPortlet');

class RecentTasks extends CPortlet
{
	public $title = 'Recent Tasks';
	public $maxTasks = 10;

	public function getRecentTasks()
	{
		return Task::model()->findRecentTasks($this->maxTasks);
	}

	protected function renderContent()
	{
		$this->render('recentTasks');
	}
}