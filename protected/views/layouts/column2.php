<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="col-xs-12 col-sm-9">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
	<div class="list-group">
	<?php
		// $this->beginWidget('zii.widgets.CPortlet', array(
		// 	'title'=>'Operations',
		// ));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'nav nav-pills nav-stacked'),
		));
		// $this->endWidget();
	?>
	</div>
</div>
<?php $this->endContent(); ?>