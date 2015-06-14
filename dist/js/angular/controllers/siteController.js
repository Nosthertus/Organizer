(function(angular)
{
	var app = angular.module('Organizer');
	
	app.controller('site', function($mdDialog, $http, $scope)
	{
		this.menu = ['test1', 'test2'];

		this.dialog = function()
		{
			$http.get('site/login')
				.success(function(data){
					login = data;
				})
				.error(function(data){
					login = data;
				});

			$mdDialog.show({
				template: login
			});
		};

		$scope.login = function()
		{
			console.log('this is login');
		};

		this.test = function()
		{
			console.log('asd');
		}
	});
})(angular);