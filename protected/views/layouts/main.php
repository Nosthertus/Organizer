<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- blueprint CSS framework -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/offcanvas.css" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/JQuery.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
			</div>
			<div class="collapse navbar-collapse">
				<?php
				$this->widget('zii.widgets.CMenu', array(
					'htmlOptions'=>array('class'=>'nav navbar-nav'),
					'items'=>array(
						array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
						array('label'=>'Contact', 'url'=>array('/site/contact')),
						array('label'=>'Tags', 'url'=>array('/task/index')),
						array('label'=>'Chat', 'url'=>'#', 'linkOptions'=>array('onClick'=>'Popup();'), 'visible'=>!Yii::app()->user->isGuest)
					)
				));

				$this->widget('zii.widgets.CMenu', array(
					'htmlOptions'=>array(
						'class'=>'nav navbar-nav navbar-right',
						),
					'items'=>array(
						array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Logout '.Yii::app()->user->name, 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					)
				));
				?>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">

		<?php echo $content; ?>

	</div><!-- /.container -->


	<div class="clear"></div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/offcanvas.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	function Popup()
	{
		var winHeight = 2000,
			winWidth = 2000,
			winPosX = 10,
			winPosY = 10;

		newwind = window.open("<?php echo Yii::app()->request->baseUrl; ?>/site/chat","NewPop",
			'fullscreen=yes, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no');

		newwind;
		// newwind.resizeTo(winHeight, winWidth);
		// newwind.moveTo(winPosX, winPosY);
	}
	</script>
</body>
</html>
