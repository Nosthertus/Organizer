<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-9">
				<h4><?php echo CHtml::Link(CHtml::encode($data->Name), array('/project/view', 'id'=>$data->id), array('data-status'=>$data->Status, 'class'=>'menu-link')); ?></h4>
				<?php echo $this->status($data->Status); ?> <b>Modules: </b><?php echo Module::model()->countModules($data->id); ?>
			</div>
			<div class="col-md-3">
				<?php
					if($data->Creator != '0')
						echo "<kbd>".$data->user->username."</kbd>";

					else
						echo "<kbd>Unknown</kbd>";
				?>
				<br><br>
				<?php
				if($data->projecTtype_id != 0)
					echo $data->type->name;

				else
					echo '<i>NULL</i>'
				?>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<?php echo CHtml::encode($data->Description); ?>
	</div>
</div>