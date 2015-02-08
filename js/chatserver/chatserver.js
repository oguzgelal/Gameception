
var WebSocketServer = require('websocket').server;
var http = require('http');
var httpserver = http.createServer().listen(80);

var wsServer = new WebSocketServer({ 
    httpServer: httpserver,
    disableNagleAlgorithm: false
});

var connections = new Array();


wsServer.on('request', function(request) {
    var connection = request.accept(null, request.origin);
    connections.push(connection);
    connection.send('message|server|Connected to the server.');
    console.log("Client connected");
});

wsServer.on('connect', function(connection){
    connection.on('message', function(message) {
        if (message.type === 'utf8') {
            var msgsplit = message.utf8Data.split("|");
            if (msgsplit[0] == "message"){
                broadcast(connection, message.utf8Data);
            }
        }
    });
});

wsServer.on('close', function(connection, closeReason, closeDescription){
    connections.splice(connIndex(connection),1);
    console.log("Connection Closed : "+closeDescription+" ("+closeReason+")");
    console.log("Remaining : "+connections.length); 
});


function connIndex(connection){
    return connections.indexOf(connection);
}
function broadcast(connection, message){
    for(var i = 0; i < connections.length; i++){
        if (connections[i].connected){
            connections[i].send(message);
        }
    }
}