<div ng-controller="login as login">
	<div layout="column" layout-align="center center">
		<h2>Login</h2>
		<div ng-show="!login.processing">
			<md-input-container flex>
				<label>Username</label>
				<input ng-model="login.username">
			</md-input-container>
			<md-input-container flex>
				<label>Password</label>
				<input type="password" ng-model="login.password">
			</md-input-container>
			<div layout="row">
				<md-button ng-click="login.submit()">Login</md-button>
			</div>
		</div>

		<div ng-if="login.processing">
			<md-progress-circular md-mode="indeterminate"></md-progress-circular>	
		</div>
	</div>
</div>