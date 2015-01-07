function toggle(data)
{
	var id = '#' + $(data).attr('data-toggle');

	$(id).toggle(150);
}