<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="col-md-1 vertical-options navbar-inverse">
	<?php
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'nav')
		));
	?>
</div>
<div class="col-md-11">
	<div id="content container">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>