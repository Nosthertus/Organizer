<?php echo CHtml::link('Change Email', '#', array('onClick'=>'toggle(this);', 'data-toggle'=>'changeEmail')); ?>
<hr>
<div id="changeEmail" style="display:none">
	<div class="well">
		<div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'user-email-form',
				'enableAjaxValidation'=>false,
				'action'=>array('View', 'id'=>$model->id, 'Email'=>true),
				'method'=>'POST'
			)); ?>

				<?php echo $form->errorSummary($model); ?>

				<div class="form-group">
					<?php echo $form->labelEx($model,'email'); ?>
					<?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'email'); ?>
				</div>


				<div class="form-group">
					<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-default')); ?>
				</div>

			<?php $this->endWidget(); ?>

		</div><!-- form -->
	</div>
</div>
<br>
<?php echo CHtml::link('Email Notifications', '#', array('onClick'=>'toggle(this);', 'data-toggle'=>'changeNotifications')); ?>
<hr>
<div id="changeNotifications" style="display:none">
		<?php $form = $this->beginWidget('CActiveForm', array(
			'id'=>'user-notification-form',
			'enableAjaxValidation'=>false,
			'action'=>array('View', 'id'=>$model->id, 'Email'=>true),
			'method'=>'POST'
		)); ?>

		<?php echo $form->checkBox($model, 'emailNotification'); ?>
		<?php echo $form->labelEx($model, 'emailNotification'); ?>
		<br>

		<div class="well" id="Notification">
			<?php echo $form->checkBox($model, 'ProjectNotification'); ?>
			<?php echo $form->labelEx($model, 'ProjectNotification'); ?>
			<br>
			<?php echo $form->checkBox($model, 'NewTaskNotification'); ?>
			<?php echo $form->labelEx($model, 'NewTaskNotification'); ?>
			<br>
			<?php echo $form->checkBox($model, 'UpdatedTaskNotification'); ?>
			<?php echo $form->labelEx($model, 'UpdatedTaskNotification'); ?>
			<br>
			<?php echo $form->checkBox($model, 'CommentedTaskNotification'); ?>
			<?php echo $form->labelEx($model, 'CommentedTaskNotification'); ?>
			<br>
		</div>

		<?php echo CHtml::submitButton('Save', array('class'=>'btn btn-default')); ?>
		<?php $this->endWidget(); ?>
</div>