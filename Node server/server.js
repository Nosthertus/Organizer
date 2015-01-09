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
	var user = {
		id: socket.handshake.query.id,
		name: socket.handshake.query.name,
		icon: socket.handshake.query.icon
	};

	users.push({
		client: user,
		socket: socket.client.conn
	});

	io.sockets.emit('connectionLog',{
		user: user
	});

	socket.on('chatServer', function(data)
	{
		var message = data.message;

		if(message.channel == 'master')
		{
			io.sockets.emit('chat',{
				message: {
					user: user,
					content: message.value,
					channel: message.channel
				}
			});
		}
	});
});

if(socket)
{
	console.log('Server initiated.');
}
