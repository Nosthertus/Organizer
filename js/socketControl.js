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
				addMessage('#chatHistory', 'System', user.data.name + ' Logged in.', user.date);
				addUserList(user.data);
			}

			if(user.status == 'disconnect')
			{
				addMessage('#chatHistory', 'System', user.data.name + ' Logged out.', user.date);
				$('#usersConnected ul li a[data-id="' + user.data.id + '"]').remove();
			}
		}
	});

	/*
	*	Server data event
	*/
	socket.on('serverData', function(data)
	{
		var users = data.users;
		var history = data.chatHistory;
		var list = '';

		for(user in users)
		{
			list += window.addUserList(users[user].client, true);
		}

		for(log in history)
			addMessage('#chatHistory', history[log].user.name, history[log].content, history[log].date, history[log].user.icon);

		$('#usersConnected').tagCreator({
			ul: {
				class: 'nav nav-stacked',
				content: list
			}
		});
	});

	/*
	*	Chat data event
	*/
	socket.on('chat', function(data)
	{
		var message = data.message;

		addMessage('#chatHistory', message.user.name, message.content, message.date, message.user.icon);
		$('#chatHistory').scrollTop($('#chatHistory')[0].scrollHeight);
	});

	/*
	*	Disconnect event
	*/

	socket.on('disconnect', function(data)
	{
		deleteData();
		addMessage('#chatHistory', 'System', 'You have been disconnected.', new Date().getTime());
	});
}