(function(angular)
{
	var app = angular.module('Organizer');

	app.controller('login', function()
	{
		this.processing = false;

		this.submit = function()
		{
			this.processing = true;
		};
	});
})(angular);