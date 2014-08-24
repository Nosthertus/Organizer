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

var socket = io.sockets.on('connection', function(socket)
{
	socket.on('messageToServer', function(data)
	{
		var msg = escape_html(data['message']);
		var user = escape_html(data['username'])

		io.sockets.emit('messageToClient',
		{
			message: msg,
			username: user
		});
	});

	socket.on('writeCollab', function(data)
	{
		io.sockets.emit('writenCollab',
		{
			collab: data['code']
		});
	});
});

socket;

console.log('Server initiated.');