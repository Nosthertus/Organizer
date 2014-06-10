<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<h1>Create Project</h1>
<br>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-create-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textField($model,'Description', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->