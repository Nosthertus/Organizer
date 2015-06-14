(function(angular)
{
	var app = angular.module('Organizer', ['ngMaterial', 'ngAnimate', 'ngAria']);

	app.config(function($mdThemingProvider)
	{
		$mdThemingProvider.theme('default')
			.primaryPalette('blue-grey');
	});

	app.factory('global', function()
	{
		var global = {
			user: {
				logged: false,
				name: null,
				id: null
			}
		};
	});
})(angular);