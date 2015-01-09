function handleSockets(socket)
{
	socket.on('connectionLog', function(data)
	{
		if(data.user)
		{
			var user = data.user;

			addMessage('#chatHistory', 'System', user.name + ' Logged in.');
		}
	});

	socket.on('chat', function(data)
	{
		var message = data.message;

		addMessage('#chatHistory', message.user.name, message.content, message.user.icon);
	});
}