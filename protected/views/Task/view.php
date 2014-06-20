<?php
	if($model->User_id == Yii::app()->user->getId())
	{
		$this->menu = array(
			array('label'=>'Edit Task', 'url'=>array('update',
				'id'=>$model->id
				),
				'linkOptions'=>array(
					'class'=>'list-group-item'
				)
			),

			array('label'=>'Delete Task', 'url'=>array('delete', 'id'=>$model->id),
				'linkOptions'=>array(
					'confirm'=>'Are you sure you want to delete this Task?',
					'class'=>'list-group-item'
				)
			)
		);
	}

	else
	{
		$this->menu = array(
			array('label'=>'Set Status', 'url'=>'#',
				'linkOptions'=>array(
					'class'=>'list-group-item'
				)
			)
		);
	}
	$this->menu[1] = array(
		'label'=>'Back to project', 'url'=>array('/project/view', 'id'=>$model->Project_id),
		'linkOptions'=>array(
			'class'=>'list-group-item item-active'
		)
	);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-9">
				<h2><?php echo $model->Name; ?></h2>
				<?php
					
					if($model->Assigned != '')
					{
						$assignment = $this->explodeByComma($model->Assigned);

						if(is_array($assignment))
						{
							foreach($assignment as $data)
								echo "<kbd>".User::model()->findByPk($data)->username."</kbd> ";
						}

						else
							echo "<kbd>".User::model()->findByPk($model->Assigned)->username."</kbd>";
					}

					else
						echo "<code>Not Assigned</code>";
				?>
			</div>
			<div class="col-md-3">
				<h2><?php echo $this->status($model->Status); ?></h2>	
				<?php foreach($model->Tags as $data): ?>
					<span class="label label-default"><?php echo $data; ?></span>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<?php if($model->Description != ''): ?>
	<div class="panel-body">
		<?php echo $model->Description; ?>
	</div>

	<?php endif; ?>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'comment',
	'emptyText'=>'No comment for this task',
	'summaryText'=>'Displaying {start}-{end} of {count} comments'
)); ?>

<hr>

<?php $this->renderPartial('_comment', array('model'=>$_model)); ?>