(function(angular)
{
	var app = angular.module('Organizer');

	app.controller('login', function($http, $rootScope)
	{
		var scope = this;
		scope.processing = false;
		scope.message = null;

		scope.submit = function()
		{
			scope.processing = true;

			// store data for post
			var post = {
				username: scope.username,
				password: scope.password
			};

			// send post data
			$http.post('api/default/login', post).
				success(function(data, status)
				{
					// hide processing feedback and show the result
					scope.processing = false;
					scope.message = data.message;

					if(data.login)
					{
						$rootScope.$broadcast('closeDialog');
						$rootScope.$broadcast('changeView', 'project');
					}
				}).
				error(function(data, status)
				{
					scope.processing = false;
				});
		};

		this.closeDialog = function()
		{
			$rootScope.$broadcast('closeDialog');
		};
	});
})(angular);