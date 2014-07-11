<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-9">
				<h4><?php echo CHtml::Link(CHtml::encode($data->Name), array('/project/view', 'id'=>$data->id), array('data-status'=>$data->Status, 'onClick'=>'Check('.$data->Status.');')); ?></h4>
				<?php echo $this->status($data->Status); ?>
			</div>
			<div class="col-md-3">
				<?php
					if($data->Creator != '0')
						echo "<kbd>".User::model()->findByPk($data->Creator)->username."</kbd>";

					else
						echo "<kbd>Unknown</kbd>";
				?>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<?php echo CHtml::encode($data->Description); ?>
	</div>
</div>