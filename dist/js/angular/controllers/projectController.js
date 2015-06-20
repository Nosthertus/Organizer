(function(angular)
{
	var app = angular.module('Organizer');

	app.controller('projectController', function($http, $mdDialog, $rootScope, global)
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

		scope.dialog = function(event, project)
		{
			$mdDialog.show({
				targetEvent: event,
				templateUrl: 'project/page?view=dialog',
				controller: 'projectController',
				controllerAs: 'pjt',
				locals: {
					data: project
				},
				bindToController: true,
				clickOutsideToClose: true
			});
		};

		scope.projectTasks = function(project)
		{
			$mdDialog.cancel();
			$rootScope.$broadcast('changeView', 'task');

			global.project = project;
		};
	});
})(angular);