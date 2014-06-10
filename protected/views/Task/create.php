<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<h1><?php echo isset($_GET['project']) ? Project::model()->findByPk($_GET['project'])->Name : '' ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-create-form',
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
		<?php 
		if(isset($_GET['project']))
		{
			echo $form->hiddenField($model,'Project_id', array('class'=>'form-control', 'value'=>$_GET['project']));
			echo CHtml::hiddenField('project', $_GET['project']);
		}

		else
		{
			echo $form->labelEx($model,'Project_id');
			echo $form->DropDownList($model,'Project_id', CHtml::listData(Project::model()->findAll(), 'id', 'Name'), array('class'=>'form-control', 'empty'=>'Select Project')); 
		}
		?>
		<?php echo $form->error($model,'Project_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description', array('class'=>'form-control', 'rows'=>8)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'Assigned'); ?>
		<div class="checkbox">
			<?php echo $form->CheckBoxList($model,'Assigned', CHtml::listData(User::model()->findAll(), 'id', 'username')); ?>
		</div>
		<?php echo $form->error($model,'Assigned'); ?>
	</div>

	<?php if(Yii::app()->Controller->action->id == 'update'): ?>
		<div class="form-group">
			<?php echo $form->labelEx($model, 'Status'); ?>
			<?php echo $form->DropDownList($model, 'Status', array(1=>'Pending', 2=>'Finished', 3=>'In Progress', 4=>'Danger'), array('class'=>'form-control')); ?>
			<?php echo $form->error($model, 'Status'); ?>
		</div>
	<?php endif; ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'Tags'); ?>
		<!-- <?php echo $form->textField($model,'Tags', array('class'=>'form-control')); ?> -->
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'Tags',
			'sourceUrl'=>$this->createUrl('Task/SuggestTags'),
			'htmlOptions'=>array('class'=>'form-control')
		)); ?>
		<?php echo $form->error($model,'Tags'); ?>
		<p class="help-block">please separate different tags with commas.</p>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->