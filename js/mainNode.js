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

	
	/*
	*	Send data to server
	*/
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

	/*
	*	Add message to chat history
	*/
	window.addMessage = function(element, subject, content, date, iconData)
	{
		var icon;
		var message;

		if(iconData)
			icon = iconData;

		else
			icon = '';

		$(element).tagCreator({
			div: {
				class: 'well well-sm',
				content: $.tagCreator({
					img:{
						alt: '',
						src: icon
					}
				}) + '<b>' + subject + '</b> ' + $.tagCreator({
					span: {
						class: 'text-muted',
						content: parseDate(date)
					}
				}) + '<br>' + parseContent(content)
			}
		});
	}

	/*
	*	Add users to list
	*/
	window.addUserList = function(user, string)
	{
		if(!string)
		{
			$('#usersConnected ul').tagCreator({
				li: {
					content: user.name,
					'data-id': user.id
				}
			});
		}

		else
		{
			return $.tagCreator({
				li: {
					content: user.name,
					'data-id': user.id
				}
			});
		}	
	};

	window.deleteData = function()
	{
		$('#usersConnected').children().remove();
	};

	/*
	* Parse date
	*/
	function parseDate(date)
	{
		var d = new Date(date);

		var time = '';

		time += d.getFullYear();
		time += '-';
		time += d.getMonth() + 1;
		time += '-';
		time += d.getDate();
		time += ' ';
		time += d.getHours();
		time += ':';
		time += d.getMinutes();
		time += ':';
		time += d.getSeconds();

		return time;
	}

	/*
	*	Parse content that contains spaces and new lines
	*/
	function parseContent(text)
	{
		var total = text;
		var newLines = total.replace(/(?:\r\n|\r|\n)/g, '<br>');
		var tabs = newLines.replace(/(?:\t)/g, '&nbsp;&nbsp;&nbsp;&nbsp;');

		var link = tabs.replace(
            /((https?\:\/\/)|(www\.))(\S+)(\w{2,4})(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/gi,
            function(url){
                var full_url = url;
                return '<a href="' + full_url + '" target="_blank">' + url + '</a>';
            }
        );
	

		return link;
	}

	handleSockets(socketio);
});