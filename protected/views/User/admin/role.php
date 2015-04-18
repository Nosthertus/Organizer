<?php
	$roles = array();

	foreach (Yii::app()->authManager->getRoles() as $key => $value)
	{
		if($key != 'Admin')
			$roles[] = $key;
	}
?>

<h1>Role</h1>
<br>

<ul class="nav nav-tabs">
	<li class="active"><a href="#list" data-toggle="tab">List</a></li>
	<li><a href="#create" data-toggle="tab">Create</a></li>
	<li><a href="#assign" data-toggle="tab">assign</a></li>
</ul>

<div class="container">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="list">
			<?php
			$this->widget('zii.widgets.grid.CGridView', array(
				'dataProvider'=>$dataProvider,
				'itemsCssClass'=>'table',
				'summaryText'=>'',
				'columns'=>array(
					'name',
					'description'
				)
			));
			?>
		</div>
		<div class="tab-pane fade" id="create">
			<?php echo CHtml::beginForm('', '', array(
				'id'=>'roleForm'
			)); ?>

			<div class="form-group">
				<?php echo CHtml::label('Name', '', array('class'=>'control-label')); ?>
				<?php echo CHtml::textField('name', '', array('class'=>'form-control', 'id'=>'roleName')); ?>
			</div>

			<div class="form-group">
				<?php echo CHtml::label('Description', '', array('class'=>'control-label')); ?>
				<?php echo CHtml::textArea('description', '', array('class'=>'form-control', 'id'=>'roleDescription')); ?>
			</div>

			<div class="form-group">
				<?php echo CHtml::submitButton('Save', array('class'=>'btn btn-default')); ?>
				<span id="roleResult" style="display:none">role result</span>
			</div>

			<?php echo CHtml::endForm(); ?>
		</div>
		<div class="tab-pane fade" id="assign">
			<?php echo CHtml::beginForm('', '', array(
				'id'=>'roleAssign'
			)); ?>

			<div class="col-md-6">
				<div class="form-group">
					<?php echo CHtml::label('User', '', array('class'=>'control-label')); ?>
					<?php echo CHtml::textField('userName', '', array('class'=>'form-control', 'id'=>'userName')); ?>
					
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<?php echo CHtml::label('Role', '', array('class'=>'control-label')); ?>
					<?php echo CHtml::dropDownList('roleAssigname', '', $roles, array('class'=>'form-control')); ?>
				</div>
			</div>

			<?php echo CHTml::endForm(); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#roleForm').submit(function()
	{
		var form = $(this).serializeJSON();

		$.ajax({
			url: '',
			type: 'GET',
			data: {
				admin: {
					role: {
						data: form
					}
				}
			},
			dataType: 'JSON',
			success: function(data)
			{
				if(data.valid)
				{
					$('#roleName').val('');
					$('#roleDescription').val('');

					showResult('Role created successfully');
				}

				else
					showResult('Error creating role');
			},
			error: function (XMLHttpRequest, textStatus, errorThrown)
			{
				console.log(XMLHttpRequest.responseText);
			}
		});

		return false;
	});

	$('#userName').unbind('keyup').keyup(function(e)
	{
		console.trace();
	});

	function showResult(message)
	{
		var result = $('#roleResult');
		var delay = 2;

		result.text(message);
		result.toggle(100);

		setTimeout(function()
		{
			result.toggle(100);
		}, delay * 1000);
	}

	function newUserRole(ui)
	{
		console.log(ui);
	}
</script>