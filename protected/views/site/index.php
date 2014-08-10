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
				)
			)
		);
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

<script type="text/javascript">
function Check(Status)
{
	if(Status == '0')
	{
		var question = confirm("Are you sure you want to start this project?");

		if(question == true)
		{
			console.log('True');
			return true;
		}

		else
		{
			console.log('False');
			return false;
		}
	}
}
</script>