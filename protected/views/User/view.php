<?php echo CHtml::image(YiiIdenticon::getImageDataUri($model->id), $model->username); ?>
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

<?php //echo CHtml::Button('Change Email', array('class'=>'btn btn-default')); ?> 	
<?php echo CHtml::ajaxLink('Change Email', array('', 'id'=>$model->id, 'Email'=>true), array('update'=>'#option'), array('class'=>'btn btn-default')); ?>	
<?php echo CHtml::ajaxLink('Change Password', array('', 'id'=>$model->id, 'Password'=>true), array('update'=>'#option'), array('class'=>'btn btn-default')); ?>	
<?php echo CHtml::ajaxLink('Favorite Tags', array('', 'id'=>$model->id, 'Tags'=>true), array('update'=>'#option'), array('class'=>'btn btn-default')); ?>	
<br><br>
<div id="option"></div>