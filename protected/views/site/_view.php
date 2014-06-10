<div class="panel panel-default">
	<div class="panel-heading">
		<h4><?php echo CHtml::Link(CHtml::encode($data->Name), array('/project/view', 'id'=>$data->id)); ?></h4>
	</div>
	<div class="panel-body">
		<?php echo CHtml::encode($data->Description); ?>
	</div>
</div>