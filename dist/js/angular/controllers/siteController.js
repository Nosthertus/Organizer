(function(angular)
{
	var app = angular.module('Organizer');
	
	app.controller('site', function($mdDialog, $rootScope)
	{
		var scope = this;
		scope.view = '';
		scope.menu = ['test1', 'test2'];

		$mdDialog.show({
			templateUrl: 'site/login',
		});

		$rootScope.$on('closeDialog', function(event, callback)
		{
			$mdDialog.cancel();

			if(callback)
				callback();
		});

		$rootScope.$on('changeView', function(event, view)
		{
			if(!view)
				throw new Error('view data is missing');

			scope.view = view;
		});
	});
})(angular);