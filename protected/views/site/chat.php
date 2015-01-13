<?php /* @var $this SiteController */ 
	$icon = YiiIdenticon::getImageDataUri(Yii::app()->user->getId(), '20');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/offcanvas.css" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/JQuery.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header" id="tabs">
				<a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
				<ul class="nav navbar-nav">
					<li class="active" data-tab="master">
						<a href="#">Master</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Node module -->
	<div id="module">
		<div id="chat">
			<!-- User list column -->
			<div id="users">
				<b>Connected</b>
				<div id="usersConnected"></div>
			</div>

			<!-- Chat log column -->
			<div id="chatHistory">
			</div>
			
			<!-- Chat menu bar -->
			<div class="navbar navbar-inverse" id="chatMenu">
				<div class="navbar-header">
					<p class="navbar-text" id="Username"><span><?php echo CHtml::image(YiiIdenticon::getImageDataUri(Yii::app()->user->getId(), '20'), '').'</span> '.Yii::app()->user->name; ?></p>
					<p class="navbar-text">[Icons and options HERE!]</p>
				</div>
				<?php echo CHtml::beginForm(null, 'post', array('id'=>'chatForm')); ?>
					<div class="form-group col-md-12">
						<?php echo CHtml::textArea('Message', '', array(
							'class'=>'form-control',
							'placeholder'=>'Connecting...',
							'autoComplete'=>'false',
							'disabled'=>true,
							'id'=>'Message'
						)); ?>
					</div>
				<?php echo CHtml::endForm(); ?>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tagCreator.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/offcanvas.js"></script>
	<script src="http://<?php echo Yii::app()->request->serverName; ?>:3000/socket.io/socket.io.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var user = {
			id: '<?php echo Yii::app()->user->getId(); ?>',
			name: '<?php echo Yii::App()->user->name; ?>',
			icon: '<?php echo $icon; ?>'
		};
	</script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/mainNode.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/socketControl.js"></script>
</body>
</html>