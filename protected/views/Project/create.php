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
		<?php echo $form->textArea($model,'Description', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'projecTtype_id'); ?>
		<?php echo $form->DropDownList($model,'projecTtype_id', CHtml::listData(ProjectType::model()->findAll(), 'id', 'name'), array('class'=>'form-control', 'empty'=>'Select Type'));?>
		<?php echo $form->error($model,'projecTtype_id'); ?>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<?php echo CHtml::label('Enable Modules', 'module'); ?><br>
			<?php echo CHtml::checkBox('module', false); ?>
		</div>

		<div class="form-group col-md-6" id="modBox" style="display:none;">
			<?php echo CHtml::label('Modules', 'module'); ?><br>
			<?php echo CHtml::dropDownList('modules', '', array(null,1,2,3,4,5,6,7,8,9)); ?>
		</div>
	</div>

	<div id="moduleLevel"></div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$(document).ready(function()
{
	$('#module').unbind('change').on('change', function(e)
	{
		addModule($(this).prop('checked'));
	});

	$('#modules').unbind('change').on('change', function(e)
	{
		modules();
	});
});

function addModule(active)
{
	if(active)
	{
		$('#modBox').show();

		console.log(document.getElementById('modules').value);
	}

	else
		$('#modBox').hide();
}

function modules()
{
	var data = $('#modules').val() * 1;

	console.log(data);

	var result = [];

	for(i = 1; i <= data; i++)
	{
		result.push(i);
	}

	var html = '';

	for(a in result)
	{			
		html += '<label class="control-label" for="modName_' + (a *1 +1) + '">Modulo ' + (a *1 +1) + '</label>	<input class="form-control" value="" name="modName_' + (a *1 +1) + '" id="modName_' + (a *1 +1) + '" type="text">	<br>'
				+'<label class="control-label" for="modDes_' + (a *1 +1) + '">Description ' + (a *1 +1) + '</label>	<textarea class="form-control" name="modDes_' + (a *1 +1) + '" id="modDes_' + (a *1 +1) + '"></textarea>';
	}
		$('#moduleLevel').html(html);
}
</script>