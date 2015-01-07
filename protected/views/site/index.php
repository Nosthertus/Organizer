<?php
/* @var $this SiteController */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/main.js');

$this->pageTitle=Yii::app()->name;
?>

<?php
$this->menu = array(
	array('label'=>'Create Project', 'url'=>array('/project/create'), 'linkOptions'=>array('class'=>'list-group-item')),
	array('label'=>'Create Task', 'url'=>array('/task/create'), 'linkOptions'=>array('class'=>'list-group-item'))
);
?>

<?php
	if(!isset($_POST['type_id']))
	{
		echo CHtml::dropdownList('type_id', '', CHtml::listData(ProjectType::model()->findAll(), 'id', 'name'),
			array(
				'prompt'=>'All',
				'ajax'=>array(
					'type'=>'POST', 
					'url'=>Yii::app()->createUrl('site'),
					'update'=>'#Projects',
					'data'=>array(
						'type_id'=>'js:this.value'
					)
				),
				'class'=>'form-control'
			)
		);
		echo '<br>';
	}
?>
<div id="Projects">
	<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'template'=>"{items}\n{pager}",
		'emptyText'=>'No project found.'
	));
	?>
</div>