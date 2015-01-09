$(document).ready(function()
{
	/*
	*	Socket control
	*/
	if(typeof io === 'undefined')
	{
		$('#Message').attr('placeholder', 'Unable connect to server...');
		$('#Message').attr('disabled', true);
	}

	else
	{
		var socketio = io.connect(window.location.hostname + ':3000',
		{
			query: $.param(window.user)
		});
		$('#Message').attr('placeholder', 'Message');
		$('#Message').attr('disabled', false);
	}

	/*
	*	Text area control
	*/
	$('#Message').keypress(function (event) {
		if (event.keyCode == 13 && !event.shiftKey){
			submitToServer({
				type: 'chat',
				message: {
					channel: 'master',
					value: $(this).val()
				}
			});
			$(this).val('');
			return false;
		}
	});

	function submitToServer(module)
	{
		if(module.type == 'chat' && module.message.value != '')
		{
			socketio.emit('chatServer',
			{
				message: module.message
			});
		}
	}

	window.addMessage = function(element, subject, content, iconData)
	{
		var icon;
		var message;

		if(iconData)
			icon = iconData;

		else
			icon = '';

		message = '<div class="well well-sm">';
		message += '<img alt="" src="' + icon + '"></img> ';
		message += '<b>' + subject + '</b><br>';
		message += content;
		message += '</div>';

		$(element).append(message);
	}

	handleSockets(socketio);
});