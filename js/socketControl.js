function handleSockets(socket)
{
	socket.on('connectionLog', function(data)
	{
		console.log(data.user);
	});
}