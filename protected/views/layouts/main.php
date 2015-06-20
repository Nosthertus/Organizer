<?php 
	// Define application variable
	$app = Yii::app();
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo $app->request->baseUrl.'/dist/css/angular-material.min.css';?>">
	<link rel="stylesheet" href="<?php echo $app->request->baseUrl.'/dist/css/flaticon.css';?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=RobotoDraft:300,400,500,700,400italic">
</head>
<body ng-app="Organizer" ng-controller="site as main">
	<div layout="column">
		<md-toolbar>
			<div class="md-toolbar-tools">
				<span><?php echo $app->name; ?></span>
				<!-- fill up the space between left and right area -->
				<span flex></span>
				
				<!-- Menu Button -->
				<md-menu>
					<md-button class="md-icon-button" aria-label="Menu" ng-click="$mdOpenMenu()">
						<md-icon md-menu-origin md-svg-icon="<?php echo $app->request->baseUrl.'/dist/icons/menu.svg';?>" alt="Menu"></md-icon>
					</md-button>
					<md-menu-content>
						<md-menu-item ng-repeat="item in main.menu"	>
							<md-button>{{item}}</md-button>
						</md-menu-item>
					</md-menu-content>
				</md-menu>
				<!-- <md-select ng-model="main.select" placeholder="Menu">
					<md-option ng-repeat="item in main.menu" ng-value="item">{{item}}</md-option>
				</md-select> -->
				<!-- /.Menu Button -->
			</div>
		</md-toolbar>
		<md-content layout-padding ng-include="main.view">
		</md-content>
	</div>
	<!-- Angular Material Dependencies -->
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular.min.js';?>"></script>
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular-animate.min.js';?>"></script>
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular-aria.min.js';?>"></script>
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular-material.min.js';?>"></script>

	<!-- Angular app -->
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular/app.js';?>"></script>
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular/controllers/siteController.js';?>"></script>
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular/controllers/loginController.js';?>"></script>
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular/controllers/projectController.js';?>"></script>
	<script src="<?php echo $app->request->baseUrl.'/dist/js/angular/controllers/taskController.js';?>"></script>
</body>
</html>