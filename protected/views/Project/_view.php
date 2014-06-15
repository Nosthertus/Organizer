<div class="box row">
	<div class="col-md-4">
		<b>Name:</b> <?php echo CHtml::encode($data->Name); ?>
		<br>
		<b>Status:</b> <?php echo $this->status($data->Status); ?>
		<br>
		<b>Created:</b> <?php echo CHtml::encode(date('Y m/d, H:i', strtotime($data->Create_time))); ?>
		<br>

		<?php if($data->Update_time != $data->Create_time):?>
			<b>Updated:</b> <?php echo CHtml::encode(date('Y m/d, H:i', strtotime($data->Update_time))); ?>
			<br>
		<?php endif;?>
		
		<b>Requester:</b> <span class="label label-danger"><?php echo CHtml::encode($data->user->username); ?></span>
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
					$final[] = User::model()->findByPk($dat)->username;
				}

				echo implode(', ', $final);
			}

			else
				echo User::model()->findByPk($data->Assigned)->username;
			
		}

		else
			echo 'Not Assigned';
		?>
	</div>
	<div class="col-md-4">
		<b>Tags:</b>
		<br>
		<?php
		if($data->Tags == '')
			echo 'No tags tagged.';

		else
			echo CHtml::encode($data->Tags);
		?>	
	</div>
	<div class="col-md-4">
		<?php echo CHtml::link('View', array('/task/view', 'id'=>$data->id), array('class'=>'btn btn-primary')); ?>
	</div>
</div>