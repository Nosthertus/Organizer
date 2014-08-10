<h1>Options</h1>
<hr>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-striped'),
	'attributes'=>array(
		'id',
		'username',
		'email'
	),
)); ?>

<?php echo CHtml::Button('Change Email', array('class'=>'btn btn-default')); ?> 
<?php echo CHtml::Button('Change Password', array('class'=>'btn btn-default')); ?>