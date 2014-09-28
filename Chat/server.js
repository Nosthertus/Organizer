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
	var user = socket.manager.handshaken[socket.id].query['user'];
	var icon = socket.manager.handshaken[socket.id].query['icon'];

	users.push(user);
	id[user] = socket.id;
	icons[user] = icon;

	//Send connected users list.
	io.sockets.emit('showClients',
	{
		users: users,
		icons: icons
	});
	io.sockets.emit('sendHistory',
	{
		history: history
	});

	socket.on('messageToServer', function(data)
	{
		var msg = escape_html(data['message']);
		var user = escape_html(data['username'])
		var msgObj ={};
		msgObj.msg = msg;
		msgObj.user = user;
		msgObj.icon = icons[user].replace(/ /g,"+");
		if(history.length>=config.maxHistory){
			history.splice(0,1);
		}
		history.push(msgObj);
		io.sockets.emit('messageToClient',
		{
			message: msg,
			username: user,
			image: data['image']
		});
	});

	socket.on('sendPrivateMessage', function(to, message, data)
	{
		var destination = id[to];

		io.sockets.socket(destination).emit('recievePrivateMessage',
		{
			message: message,
			username: user,
			image: data['image']
		});
	});

	socket.on('disconnect', function()
	{
		var index = users.indexOf(user);
		users.splice(index, 1);

		delete id[user];
		delete id[user];

		io.sockets.emit('showClients',
		{
			users: users
		});
	});
	socket.on('debugR',function(data){

		if(data['password'] == password)
		{
			io.server.close();

			console.log('Restarting..');
			var config = fs.readFileSync('config.json');
			var config = JSON.parse(config);
			var port = config.port;

			if(socket)
			{
				console.log('Server initiated');
			}

			else
			{
				console.log('Could not restart');
			}
		}

		else
		{
			console.log('Command refused from ' + socket.manager.handshaken[socket.id].address['address']);
		}
	});
});

if(socket)
{
	console.log('Server initiated.');
}
