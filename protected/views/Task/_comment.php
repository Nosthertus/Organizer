<?php
/* @var $this TaskController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-_comment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Write a Comment of this task</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->textArea($model,'Content', array('class'=>'form-control', 'rows'=>3)); ?>
		<?php echo $form->error($model,'Content'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->