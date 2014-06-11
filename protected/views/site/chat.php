<?php /* @var $this SiteController */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/offcanvas.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
			</div>
		</div>
	</div>
	<div id="chatBox"></div>

	<div class="navbar navbar-inverse navbar-fixed-bottom">
		<div class="navbar-header">
			<p class="navbar-text"><?php echo Yii::app()->user->name; ?></p>
			<p class="navbar-text">[Icons and options HERE!]</p>
		</div>
		<?php echo CHtml::beginForm(null, 'post', array('id'=>'messageForm')); ?>
			<div class="form-group col-md-12">
				<?php echo CHtml::textField('Message', '', array(
					'class'=>'form-control',
					'placeholder'=>'Message',
					'autoComplete'=>'false',
					'id'=>'Message'
				)); ?>
			</div>
		<?php echo CHtml::endForm(); ?>
	</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/JQuery.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/offcanvas.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap.min.js"></script>
	<script src="/socket.io/socket.io.js"></script>
	<script type="text/javascript">
		var socketio = io.connect(window.location.hostname+':3000');
		
		window.onload = init();

		socketio.on('messageToClient', function(data)
		{
			var chatLog = document.getElementById('chatBox');

			chatLog.innerHTML = chatLog.innerHTML + '<div><pre>' + data['message'] + '</pre></div>';
			chatLog.scrollTop = chatLog.scrollHeight;
		});

		function init()
		{
			var messageForm = document.getElementById('messageForm');

			messageForm.onsubmit = send;
		}

		function send()
		{
			var message = document.getElementById('Message');
			
			if(message.value != '')
			{
				socketio.emit('messageToServer',
				{
					message: message.value
				});
				
				message.value = '';
			}
			return false;
		}
	</script>
</body>
</html>