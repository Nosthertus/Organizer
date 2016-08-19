$(document).ready(function()
{
	function toggle(data)
	{
		var id = '#' + $(data).attr('data-toggle');

		$(id).toggle(150);
	}

	// Fill remaining sidebar height
	fillSidebarHeight();

	function fillSidebarHeight()
	{
		var bodyHeight = $('body').height(),
			navbarHeight = $('.navbar').height();

		console.log(bodyHeight, navbarHeight);

		$('#sidebar').height(bodyHeight - navbarHeight  + 70 - 1);
	}

	$('.category').click(function()
	{
		var list = $(this).parent().find('ul');

		list.toggle(200);
	});

	window.autocomplete = function(element, data, callback)
	{
		if(jQuery.ui)
		{
			var obj = {};

			$(element).autocomplete({
				source: function(request, response)
				{
					response(data);
				},
				select: function(event, ui)
				{
					callback(event, ui);
				}
			});
		}
	}
});