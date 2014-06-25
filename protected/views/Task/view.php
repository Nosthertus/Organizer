
<?php Yii::app()->getClientScript()->registerScriptFile('../js/JQuery-ui.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile('../js/status.js'); ?>

<?php Yii::app()->getClientScript()->registerCssFile('../dist/css/jquery-ui.css'); ?>
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

			array('label'=>'Delete Task', 'url'=>'#',
				'linkOptions'=>array(
					'id'=>'delete',
					'class'=>'list-group-item',
					'data-value'=>$model->id
				)
			)
		);
	}

	else
	{
		$this->menu = array(
			array('label'=>'Set Status', 'url'=>'#',
				'linkOptions'=>array(
					'class'=>'list-group-item',
					'id'=>'Status'
				)	
			)
		);
	}
	
	array_push($this->menu, array(
		'label'=>'Back to project', 'url'=>array('/project/view', 'id'=>$model->Project_id),
		'linkOptions'=>array(
			'class'=>'list-group-item item-active'
		)
	));
?>
<!-- <div id="dialog" title="Basic dialog">
  
</div> -->

<div id="dialogHC" style="display: none">
     <div>
     	<select id="selectStatus">
  	<option value="1">Pending</option>
  	<option value="2">Finished</option>
  	<option value="3">In progress</option>
  	<option value="4">Danger</option>
  </select>
  <button id="sendStatus">Send</button></div>
  </div>  
  <!-- Popover 2 hidden title -->
  <div id="dialogHT" style="display: none">
  	Select new Status
  </div> 




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
