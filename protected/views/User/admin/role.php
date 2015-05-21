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
		<!-- Role list -->
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
		<!-- ./Role list -->

		<!-- Role form -->
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
		<!-- ./Role form -->

		<!-- Role assign -->
		<div class="tab-pane fade" id="assign">
			<?php echo CHtml::beginForm('', '', array(
				'id'=>'roleAssign'
			)); ?>

			<div class="col-md-6">
				<div class="form-group">
					<?php echo CHtml::label('User', '', array('class'=>'control-label')); ?>
					<?php echo CHtml::textField('userName', '', array('class'=>'form-control', 'id'=>'userName')); ?>
				</div>

				<div class="form-group">
					<ul id="userList"></ul>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<?php echo CHtml::label('Role', '', array('class'=>'control-label')); ?>
					<?php echo CHtml::dropDownList('roleAssigname', '', $roles, array('class'=>'form-control')); ?>
				</div>

				<div class="form-group">
					<input class="btn btn-default" type="submit" value="Submit"></input>
				</div>
			</div>

			<?php echo CHTml::endForm(); ?>
		</div>
		<!-- ./Role assign -->
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

	// Remove user on list to assign for a role
	$('#userList').on('click', 'li span.glyphicon-remove', function(e)
	{
		console.log($(this).parent().remove());
	});

	// Submit the users to assign a role
	$('#roleAssign').submit(function()
	{
		var idlist = getAssignedIds(),
			role = $('#roleAssigname').val();

		$.ajax({
			url: '<?php $this->createUrl("user/view", array("id"=>Yii::app()->user->getId())); ?>',
			type: 'GET',
			data: {
				admin: {
					role: {
						assign: {
							users: userList,
						}
					}
				}
			},
			dataType: 'JSON',
			success: function(data)
			{
				console.log(data);
			},
			error: function(error)
			{
				console.log('Error assign');
			}
		});

		return false;
	});

	$('#userName').unbind('keyup').keyup(function(e)
	{
		var element = this;
		clearTimeout(ajax);
		var ajax = setTimeout(function()
		{
			$.ajax({
				url: '<?php $this->createUrl("user/view", array("id"=>Yii::app()->user->getId())); ?>',
				type: 'GET',
				data: {
					admin: {
						role: {
							searchUser: $(element).val()
						}
					}
				},
				dataType: 'JSON',
				success: function(data)
				{
					autocomplete(element, data, function(event, ui)
					{
						console.log(ui);

						setTimeout(function()
						{
							$(element).val('');

							if(!isListed('#userList', ui.item.id))
							{
								$('#userList').tagCreator({
									li: {
										'data-id': ui.item.id,
										content: ui.item.value + $.tagCreator({
											span: {
												class: 'glyphicon glyphicon-remove pull-right'
											}
									 	})
									}
								});
							}
						}, 10);
					});
				},
				error: function(error)
				{
					console.log("Errossr");
				}
			});
		}, 650);
	});

	function isListed(list, data)
	{
		var found = $(list).children('li[data-id="' + data + '"]');

		if(found.length > 0)
			return true;

		return false;
	}

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

	function getAssignedIds()
	{
		var summ = [];
		$('#userList > li').each(function(index)
		{
			summ.push($(this).data('id'));
		});

		return summ;
	}
</script>