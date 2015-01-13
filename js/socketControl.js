function handleSockets(socket)
{
	/*
	*	Logging event
	*/
	socket.on('Log', function(data)
	{
		if(data.user)
		{
			var user = data.user;

			if(user.status == 'connect')
			{
				addMessage('#chatHistory', 'System', user.name + ' Logged in.');
				addUserList(user.name);
			}

			if(user. status == 'disconnect')
			{
				console.log('delete user data');
			}
		}
	});

	/*
	*	Server data event
	*/
	socket.on('serverData', function(data)
	{
		var users = data.users;
		var list = '';

		for(user in users)
			list += '<li>' + users[user].client.name + '</li>';

		$('#usersConnected').html('<ul>' + list + '</ul>');
	});

	/*
	*	Chat data event
	*/
	socket.on('chat', function(data)
	{
		var message = data.message;

		addMessage('#chatHistory', message.user.name, message.content, message.user.icon);
		$('#chatHistory').scrollTop($('#chatHistory').height());
	});
}