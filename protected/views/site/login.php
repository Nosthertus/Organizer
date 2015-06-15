<md-dialog ng-controller="login as login">
	<md-toolbar>
		<div class="md-toolbar-tools">
			<h2>Login</h2>
			<span flex></span>
			<md-button class="md-icon-button" ng-click="login.closeDialog()">
				<md-icon md-font-icon="flaticon-cross5" aria-label="close"></md-icon>
			</md-button>
		</div>
	</md-toolbar>
	<md-dialog-content>
		<form ng-submit="login.submit()">
			<div layout="column" layout-align="center center">
				<!-- LoginForm -->
				<div ng-show="!login.processing">
					<p ng-show="login.message">{{login.message}}</p>
					<md-input-container flex>
						<label>Username</label>
						<input aria-label="Username" ng-model="login.username" minlength="6" md-maxlength="12" required>
					</md-input-container>
					<md-input-container flex>
						<label>Password</label>
						<input aria-label="Password" type="password" ng-model="login.password" minlength="6" md-maxlength="14" required>
					</md-input-container>
					<div layout="row">
						<md-button ng-click="login.submit()">Login</md-button>
					</div>
				</div>
				<!-- /.LoginForm -->

				<div ng-if="login.processing">
					<md-progress-circular md-mode="indeterminate"></md-progress-circular>	
				</div>
			</div>
		</form>
	</md-dialog-content>
</md-dialog>