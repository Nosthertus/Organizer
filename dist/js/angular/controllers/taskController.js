(function(angular)
{
	var app = angular.module('Organizer');

	app.controller('taskController', function($http, global)
	{
		var scope = this;
		scope.project = global.project;

		$http.get('api/tasks/all').
			success(function(data, status)
			{
				scope.tasks = data;
			}).
			error(function(data, status)
			{
				console.log('error');
			});
	});
})(angular)