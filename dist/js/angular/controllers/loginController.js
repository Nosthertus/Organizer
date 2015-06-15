(function(angular)
{
	var app = angular.module('Organizer');

	app.controller('login', function($http)
	{
		var scope = this;
		scope.processing = false;

		scope.submit = function()
		{
			scope.processing = true;

			var post = {
				username: scope.username,
				password: scope.password
			};

			$http.post('api/default/login', post).
				success(function(data, status)
				{
					console.log(data);
					scope.processing = false;
				}).
				error(function(data, status)
				{
					console.log('error', data);
					scope.processing = false;
				});
		}
	});
})(angular);