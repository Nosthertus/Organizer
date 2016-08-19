<?php
switch ($data->Status)
{
	case '1':
		$status = '#428BCA';
		$background = '#BADFFF';
		break;
	
	case '2':
		$status = '#5CB85C';
		$background = '#B6FCB6';
		break;
	
	case '3':
		$status = '#5BC0DE';
		$background = '#ADECFF';
		break;
	
	default:
		$status = '#D9534F';
		$background = '#FFC17A';
		break;
}
?>

<div class="box row" style="border-color: <?php echo $status; ?>; background-color: <?php echo $background; ?>;">
	<div class="col-md-4">
		<b>Project:</b> <?php echo CHtml::encode(Project::model()->findByPk($data->Project_id) ? Project::model()->findByPk($data->Project_id)->Name : 'NULL') ; ?>
		<br>
		<b>Name:</b> <?php echo CHtml::encode($data->Name); ?>
		<br>
		<b>Tags:</b>
		<br>
		<?php
		if($data->Tags == '')
			echo 'No tags tagged.';

		else
			echo CHtml::encode($this->removeSpace($data->Tags));
		?>	
	</div>
	<div class="col-md-4">
		<b>Status:</b> <?php echo $this->status($data->Status); ?>
		<br>
		<b>Requester:</b> <span class="label label-warning"><?php echo CHtml::encode($data->user->username); ?></span>
		<br>
		<b>Assigned:</b>
		<?php
		if($data->Assigned != '')
		{
			if(strpos($data->Assigned, ',') !== false)
			{
				$string = $this->explodeByComma($data->Assigned);

				$final = array();
				foreach($string as $dat)
				{
					$final[] = '<span class="label label-danger">'.User::model()->findByPk($dat)->username.'</span>';
				}

				echo implode(' ', $final);
			}

			else
				echo '<span class="label label-danger">'.User::model()->findByPk($data->Assigned)->username.'</span>';
			
		}

		else
			echo 'Not Assigned';
		?>
	</div>
	<div class="col-md-4">
		<b>Created:</b> <?php echo CHtml::encode(date('Y m/d, H:i', strtotime($data->Create_time))); ?>
		<br>
		<?php if($data->Update_time != $data->Create_time):?>
			<b>Updated:</b> <?php echo CHtml::encode(date('Y m/d, H:i', strtotime($data->Update_time))); ?>
			<br>
		<?php endif;?>
		<?php echo CHtml::link('View', array('/task/view', 'id'=>$data->id), array('class'=>'btn btn-primary')); ?>
	</div>
</div>