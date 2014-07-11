<ol>
	<?php foreach($this->getRecentTasks() as $task): ?>
	<li>
		<?php echo CHtml::link(CHtml::encode($task->Name), array('/task/view', 'id'=>$task->id));?>
	</li>
	<?php endforeach; ?>
</ol>