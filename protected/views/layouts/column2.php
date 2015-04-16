<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="row">
	<div class="col-xs-12 col-md-9">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="col-xs-6 col-md-3 sidebar-offcanvas" role="navigation">
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
		


		<?php if($this->isHome()): ?>
		<div class="list-group">
			<div class="list-group active">
				<?php
				$this->widget('recentTasks', array(
					'maxTasks'=>10,
					'htmlOptions'=>array('class'=>'list-group-item')
				));
				?>
			</div>
		</div>
		<?php endif; ?>
	</div>
	</div>
</div>
<?php $this->endContent(); ?>