<?php
$this->menu = array(
	array('label'=>'Create Task', 'url'=>array('/task/create', 'project'=>$model->id), 'linkOptions'=>array('class'=>'list-group-item'))
);
?>

<h1>Tasks</h1>

<h3><span class="label label-default"><?php echo $model->Name; ?></span></h3>
<hr>

<?php
$this->widget('zii.widgets.ClistView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
	'emptyText'=>'No task for this project'
));
?>