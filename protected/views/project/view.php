<?php
/*
*	$this ProjectController
*/
?>

<?php Yii::app()->getClientScript()->registerScriptFile('../js/user.js'); ?>

<?php
$this->menu = array(
	array('label'=>'Create Task', 'url'=>array('/task/create', 'project'=>$model->id), 'linkOptions'=>array('class'=>'list-group-item'))
	);
	?>

	<h1>Tasks</h1>

	<h3><span class="label label-default"><?php echo $model->Name; ?></span></h3>
	<hr>

	<div class="row">
		<div class="col-md-4">
			<p class="help-block">Sort by Status.</p>
			<?php echo CHtml::dropdownList('criteriaStatus', isset($_GET['status']) ? array($_GET['status']) : '', array(0 => 'All', 1 => 'Pending', 2 => 'Finished', 3 => 'In progress', 4 => 'Danger'), array(
				'onChange'=>'Status();',
				'id'=>'criteriaStatus',
				'class'=>'form-control'
			)); ?> 
		</div>

		<div class="col-md-4">
			<p class="help-block">Sort by Modules.</p>
			<?php echo CHtml::dropdownList('criteriaModules', '', CHtml::listData(Module::model()->getFromProject($model->id), 'id', 'name'), array(
				'empty'=>Project::model()->hasModules($model->id) ? 'Modules' : 'No modules',
				'disabled'=>!Project::model()->hasModules($model->id),
				'class'=>'form-control',
				'ajax'=>array(
					'type'=>'POST',
					'url'=>'',
					'update'=>'.list-view',
					'data'=>array(
						'module_id'=>'js:this.value'
					)
				)
			)); ?>
		</div>

		<div class="col-md-4">
			<p class="help-block">Sort by User.</p>
			<?php echo CHtml::dropdownList('criteriaAssigned', isset($_GET['user']) ? array($_GET['user']) : '', CHtml::listData(User::model()->findAll(), 'id', 'username'), array(
				'onChange'=>'Assigned();',
				'id'=>'criteriaAssigned',
				'empty'=>'All',
				'class'=>'form-control'
			)); ?>
		</div>
	</div>
	<br>

	<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'template'=>"{items}\n{pager}",
		'emptyText'=>'No task for this project'
		));
		?>

		<script type="text/javascript">
		function Status()
		{
			var dropdownUser = document.getElementById('criteriaAssigned');
			var dropdownStatus = document.getElementById('criteriaStatus');
			var status="";
			var user="";
			if(dropdownStatus.options[dropdownStatus.selectedIndex].value != '')
				status = dropdownStatus.options[dropdownStatus.selectedIndex].value;

			if(dropdownUser.options[dropdownUser.selectedIndex].value != '')
				user = dropdownUser.options[dropdownUser.selectedIndex].value;


			if(user!=0 && status==0){
				$.ajax({
					url: '',
					type:'GET',
					data :{
						user: user
					},
					success:function(data, status){
						
						$('body').html(data);
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						$('body').append(XMLHttpRequest.responseText);
					}
				});
			}
			else if(user==0 && status!=0){
				$.ajax({
					url: '',
					type:'GET',
					data :{
						status: status
					},
					success:function(data, status){
						
						$('body').html(data);
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						$('body').append(XMLHttpRequest.responseText);
					}
				});
			}
			else if(user!=0 && status!=0){
				$.ajax({
					url: '',
					type:'GET',
					data :{
						status: status,
						user:user
					},
					success:function(data, status){
						
						$('body').html(data);
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						$('body').append(XMLHttpRequest.responseText);
					}
				});
			}
			else if(user==0 && status==0){
				$.ajax({
					url: '',
					type:'GET',
					data :{
					},
					success:function(data, status){
						
						$('body').html(data);
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						$('body').append(XMLHttpRequest.responseText);
					}
				});
			}

			



		}

		function Assigned()
		{
			Status();
		}

		function GETMethod(data)
		{		
			var url = data;

			if(url.indexOf('?') != -1)
			{
				var GET = url.split('?');

				return GET;
			}

			else
				return url;
		}
		</script>