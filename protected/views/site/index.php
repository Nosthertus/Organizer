<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php
$this->menu = array(
	array('label'=>'Create Project', 'url'=>array('/project/create'), 'linkOptions'=>array('class'=>'list-group-item')),
	array('label'=>'Create Task', 'url'=>array('/task/create'), 'linkOptions'=>array('class'=>'list-group-item'))
);
?>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
	'emptyText'=>'No project found.'
));
?>