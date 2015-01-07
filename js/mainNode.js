$(document).ready(function()
{
	/*
	*	Text area control
	*/
	$('#Message').keypress(function (event) {
		if (event.keyCode == 13 && !event.shiftKey){
			submitToServer({
				type: 'chat',
				message: $(this).val()
			});
			$(this).val('');
			return false;
		}
	});

	function submitToServer(module)
	{
		if(module.type == 'chat' && module.message != '')
			console.log(module.message);
	}
});