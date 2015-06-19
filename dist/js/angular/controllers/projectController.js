(function(angular)
{
	var app = angular.module('Organizer');

	app.controller('projectController', function($http, $mdDialog)
	{
		var scope = this;

		// get all projects
		$http.get('api/projects/all').
			success(function(data, status)
			{
				scope.projects = data;
			}).
			error(function(data, status)
			{
				throw new Error('Error on project data');
			});

		scope.dialog = function(event)
		{
			$mdDialog.show({
				targetEvent: event,
				templateUrl: 'project/page?view=dialog'
			});
		};
	});
})(angular);