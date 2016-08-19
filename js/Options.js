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
});