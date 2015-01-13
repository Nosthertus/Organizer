/*
* Chat server for Organizer.
*/

//Load Modules
var http = require('http'),
	io = require('socket.io'),
	escape_html = require('escape-html'),
	fs = require('fs');

console.log('Loading configuration');

var config = fs.readFileSync('config.json');
var config = JSON.parse(config);
var port = config.port;
var password = config.password;


console.log('Configuration file loaded successfully.');

//Set message whenever someone tries to get 
var server = http.createServer(function(request, response)
{
	response.writeHead(400, {'Content-type':'text/plain'});
	response.write('Access rejected.');
	response.end();
});

server.listen(port);
var io = io.listen(server);
io.set('log', 0);

var users = [];
var id = {};
var icons = {};
var history = [];

var socket = io.sockets.on('connection', function(socket)
{
	/*
	*	Store socket's info
	*/
	var user = {
		id: socket.handshake.query.id,
		name: socket.handshake.query.name,
		icon: socket.handshake.query.icon
	};


	users.push({
		client: user,
		socket: {
			id: socket.id,
			remoteAddress: socket.client.conn.remoteAddress,
			date: new Date().getTime()
		}
	});

	/*
	*	Send information to sockets
	*/
	io.sockets.emit('Log',{
		user: {
			status: 'connect',
			data: user,
			date: new Date().getTime()
		}
	});

	socket.emit('serverData',{
		users: users,
		chatHistory: history,
	});

	/*
	*	Send chat message
	*/
	socket.on('chatServer', function(data)
	{
		var message = data.message;
		var log = {
			user: user,
			content: escape_html(message.value),
			channel: message.channel,
			date: new Date().getTime()
		};

		history.push(log);

		if(message.channel == 'master')
		{
			io.sockets.emit('chat',{
				message: log
			});
		}
	});

	/*
	*	Delete socket's info on disconnect and send the log to all sockets
	*/
	socket.on('disconnect', function(data)
	{
		for(index in users)
		{
			if(users[index].socket.id == socket.id)
			{
				io.sockets.emit('Log',{
					user: {
						status: 'disconnect',
						data: user
					}
				});

				users.splice(index, 1);
			}
		}
	});
});

if(socket)
{
	console.log('Server initiated.');
}