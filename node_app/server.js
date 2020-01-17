// server.js

var express = require('express');
var http = require('http').Server(app); //1
var sess = require('express-session');

var app = express();
var io = require('socket.io')(http);    //1
var sessionMiddleware = sess({secret:"s-e-c"});
app.use(sessionMiddleware);
let iconv = require('iconv-lite');
/*
session({
    genid: function(req) {
        return genuuid() // use UUIDs for session IDs
    },
    secret: ‘keyboard cat’
})
*/
/*
app.get('/',function(req, res){  //2
    console.log("succ");
    //res.sendFile(__dirname + '/client.html');
});
*/
var count=1;

var users = [];
var userKey = {};
var userValue = {};
io.on('connection', function(socket){ //3
    console.log(socket)
    var name = "user" + count++;                 //3-1
    //console.log(socket.handshake.query.realid);
    users[socket.handshake.query.nick_name] = {"sId" : socket.id, "cId": name,"sess_id": socket.handshake.query.realid};
    //console.log(socket.client)
        //console.log(socket.client);
    console.log("###############connection################");
    console.log(users);
    console.log("###############connection::E################");

    io.use(function (socket,next){
        sessionMiddleware(socket.request, socket.request.res || {}, next);
    });

    //console.log(socket.request);
    io.to(socket.id).emit('change name',name);   //3-1

    socket.on('disconnect', function(){ //3-2
        console.log("###############disconnection################");
        console.log('user disconnected: ', socket.handshake.query.nick_name);
        delete users[socket.handshake.query.nick_name];
        console.log(users);
        console.log("###############dis connection :: EE################");


    });

    socket.on('send message', function(obj){ //3-3
        console.log("############server receive##########");

        var mms = iconv.decode(obj.msg,"utf-8");
        console.log(mms);

        console.log("############server receive##########");

        //var msg = name + ' : ' + text;
        //console.log(msg);
        io.to(users[obj.to_user].sId).emit('receive message', obj.user +" : " + encodeURI(obj.msg) + "<br/>");

    });

    socket.on("set nick name",function(obj){
        users[socket.handshake.query.realid].nick_name =obj.nick_name
        console.log(users)
    })

    io.emit("get user",users);

});

http.listen(3030,"192.168.10.10", function(){ //4
    console.log('server on!');
});
