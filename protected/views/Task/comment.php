<div class="box">
	<blockquote>
	<p><?php echo User::model()->findByPk($data->Author)->username; ?></p>
	</blockquote>
	<p class="text-justify"><?php echo $data->Content; ?></p>
	<p class="text-right"><?php echo date('Y m/d, H:i', strtotime($data->Create_time)); ?></p>
</div>