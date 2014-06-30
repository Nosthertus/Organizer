<?php
/*
*	$this ProjectController
*/
?>

<?php Yii::app()->getClientScript()->registerScriptFile('../js/user.js'); ?>

<h1>Tasks</h1>
<hr>

<div class="row">
	<div class="col-md-4">
		<p class="help-block">Sort by Status.</p>
		<?php echo CHtml::dropdownList('criteriaStatus', isset($_GET['status']) ? array($_GET['status']) : '', array(0 => 'All', 1 => 'Pending', 2 => 'Finished', 3 => 'In progress', 4 => 'Danger'), array('onChange'=>'Status();', 'id'=>'criteriaStatus')); ?> 
	</div>

	<div class="col-md-4 col-md-offset-4">
		<p class="help-block">Sort by User.</p>
		<?php echo CHtml::dropdownList('criteriaAssigned', isset($_GET['user']) ? array($_GET['user']) : '', CHtml::listData(User::model()->findAll(), 'id', 'username'), array('onChange'=>'Assigned();', 'id'=>'criteriaAssigned', 'empty'=>'All')); ?>
	</div>
</div>
<br>

<?php
$this->widget('zii.widgets.ClistView', array(
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