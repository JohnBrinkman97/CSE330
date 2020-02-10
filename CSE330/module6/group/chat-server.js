// Require the packages we will use:
var http = require("http"),
	socketio = require("socket.io"),
	fs = require("fs");

// Listen for HTTP connections.  This is essentially a miniature static file server that only serves our one file, client.html:
var app = http.createServer(function(req, resp){
	// This callback runs when a new connection is made to our HTTP server.

	fs.readFile("client.html", function(err, data){
		// This callback runs when the client.html file has been read from the filesystem.
		
		if(err) return resp.writeHead(500);
		resp.writeHead(200);
		resp.end(data );
	});
});
app.listen(3456);
var roomList = new Array();
// Do the Socket.IO magic:
var io = socketio.listen(app);
var roomNumber =0;
var userNum =0;
var user = new Object();
var userList = new Array();
io.sockets.on("connection", function(socket){
	// This callback runs when a new Socket.IO connection is established.

	user.sock = socket.id;
	
	socket.on('message_to_server', function(data) {
		// This callback runs when the server receives a new message from the client.
		
		console.log("message: "+data["message"]); // log it to the Node.JS output
		console.log("user2: " +data["username"]);
		console.log(data['roomNumber']);
		io.sockets.to(data['roomNumber']).emit("message_to_client",{message:data["message"],username:data["username"],direct:false }) // broadcast the message to other users
	});
		socket.on('directMessage', function(data) {
		// This callback runs when the server receives a new message from the client.
		sockUser = data['userSock'];
		message=data['message'];
		console.log(message+sockUser);
		io.sockets.to(sockUser).emit("message_to_client",{message:data["message"],username:data["username"],direct:true }) // broadcast the message to other users
	});
	socket.on('user_to_server',function(data){
	
		console.log("user: "+data["username"]);
		
		user.username= data["username"];  
		user.userNum = userNum++;
		 socket.emit("user_to_client",{user:user});
		 io.sockets.emit("rooms_to_client",{rooms:roomList});
	});
	socket.on('leave_room',function(data){
	socket.leave(data['roomNum']);
	var roomNum = data["roomNum"];
	for(i=0;i<roomList.length;i++){
		if(roomList[i].roomNumber == data['roomNum']){
		for(j=0;j<roomList[i].users.length;j++){
		if(roomList[i].users[j].userNum == data['userNum']){
		var index = roomList[i].users.indexOf(data['userNum']);
		console.log(j);
		roomList[i].users.splice(j,1);
		console.log(roomList[i].users);
		}
		}
		}
	}
	io.sockets.emit('userJoined',{room:roomList[roomNum]});
	socket.emit('left_room',{rooms:roomList});
	socket.emit("rooms_to_client",{rooms:roomList});
	});
	socket.on('newRoom', function(data) {
		// This callback runs when the server receives a new message from the client.
		console.log("room name: "+data["roomName"]);
		var roomName= data["roomName"]; // log it to the Node.JS output
		var room = new Object();
		room.owners = new Array();
		room.users = new Array();
		room.bannedList= new Array();
		room.kickedList=new Array();
		room.roomNumber= roomNumber++; 
		room.roomName = roomName; 
		room.users.push(data['user']);
		room.isPrivate=data['priv'];
		socket.join(room.roomNumber); 
		if(data['priv'] == true){
		room.password = data['password'];
		}
		else{ room.password = '';}
		room.owners.push(data['user']);
		//room.users.push(data["username"]);
		roomList.push(room);
		console.log("user2: " +data["username"]);
		io.sockets.emit("rooms_to_client",{rooms:roomList});
		socket.emit('joined_room_to_client',{room: roomList[room.roomNumber]});
		io.sockets.emit('userJoined',{room:roomList[room.roomNumber]});
	});
		socket.on('joinRoom',function(data){
		
		console.log("user: "+data["username"]);
		var user = data["user"];
		roomList[data["roomNumber"]].users.push(data["user"]);
		var roomNum = data["roomNumber"];
		var userNum = user.userNum;

		socket.join(roomNum);
		io.sockets.emit("rooms_to_client",{rooms:roomList});
		socket.emit('joined_room_to_client',{room: roomList[roomNum]});
		io.sockets.emit('userJoined',{room:roomList[roomNum]});
				for(i=0;i<roomList.length;i++){
		if(roomList[i].roomNumber == roomNum){
		var kickRoom = roomList[i];
			for(j=0;j<kickRoom.kickedList.length;j++){
				if(kickRoom.kickedList[j].userNum == userNum){
				console.log('unkick');
				roomList[i].kickedList.splice(j,1);
				}
			}
		}
	}
	});
	socket.on('banUser',function(data){
		var userNum = data["userNum"];
		var roomNum = data["roomNumber"];
		console.log('here');
	for(i=0;i<roomList.length;i++){
		if(roomList[i].roomNumber == roomNum){
		var banRoom = roomList[i];
			for(j=0;j<banRoom.users.length;j++){
				if(banRoom.users[j].userNum == userNum){
				console.log('aqui');
				banRoom.bannedList.push(banRoom.users[j]);
				
				}
			}
		}
	}

		io.sockets.emit('userJoined',{room:roomList[roomNum]});
	});
	socket.on('kickUser',function(data){
		var userNum = data["userNum"];
		var roomNum = data["roomNumber"];
		console.log('here');
	for(i=0;i<roomList.length;i++){
		if(roomList[i].roomNumber == roomNum){
		var banRoom = roomList[i];
			for(j=0;j<banRoom.users.length;j++){
				if(banRoom.users[j].userNum == userNum){
				
				banRoom.kickedList.push(banRoom.users[j]);
				console.log(banRoom.users[j]);
				roomList[i].users.splice(j,1);
				}
			}
		}
	}

		io.sockets.emit('userJoined',{room:roomList[roomNum]});
	});
		socket.on('makeAdmin',function(data){
		var userNum = data["userNum"];
		var roomNum = data["roomNumber"];
		console.log('here');
	for(i=0;i<roomList.length;i++){
		if(roomList[i].roomNumber == roomNum){
	
			for(j=0;j<roomList[i].users.length;j++){
				if(roomList[i].users[j].userNum == userNum){
				
				roomList[i].owners.push(roomList[i].users[j]);
				
				}
			}
		}
	}
	io.sockets.emit('userJoined',{room:roomList[roomNum]});
	});
});