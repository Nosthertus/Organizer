(function(angular)
{
	var app = angular.module('Organizer');
	
	app.controller('site', function($mdDialog, $scope)
	{
		this.menu = ['test1', 'test2'];

		$mdDialog.show({
			templateUrl: 'site/login',
		});

		$scope.$on('closeDialog', function(event)
		{
			$mdDialog.cancel();
		});
	});
})(angular);