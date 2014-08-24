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