<ol>
	<?php foreach($this->getRecentTasks() as $task): ?>
		<li>
			<a>
				<?php echo CHtml::link(CHtml::encode($task->Name), array('/task/view', 'id'=>$task->id));?>
			</a>
		</li>
	<?php endforeach; ?>
</ol>
