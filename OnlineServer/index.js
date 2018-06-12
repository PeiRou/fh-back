var http = require('http');
var redis = require('redis');
var client = redis.createClient(6379, "127.0.0.1");
client.on("error", function (error) {
    console.log(error);
});

var server = http.createServer(function (req, res) {
    //res.statusCode = 200;
    res.writeHead(200, {
        'Access-Control-Allow-Origin' : '*'
    });
}).listen(3000,function () {
    console.log('Server running 3000!')
});

var io = require('socket.io').listen(server);
var onlineUsers = {}; //在线用户
var onlineUserIds = {};
var onlineCount = 0;  //当前在线人数

io.sockets.on('connection',function (socket) {
    console.log('a user connected!');
    socket.on('login',function (obj) {
        socket.name = obj.userid;
        //检查在线列表，如果不在里面就加入
        if(!onlineUsers.hasOwnProperty(obj.userid)){
            onlineUsers[obj.userid] = obj.username;
            //在线人数
            onlineCount++;
        }

        //向所有客户端广播有用户加入
        io.emit('login',{onlineUsers:onlineUsers, onlineCount:onlineCount, user:obj});
        //redis
        client.set('onlineUser',JSON.stringify(onlineUsers).toString(), function (err, res) {
            if(err){
                console.log(err);
            } else {
                console.log(res);
            }
        });
        console.log(obj.username+'当前在线,用户id：'+obj.userid);
    });
    
    //用户退出
    socket.on('disconnect',function () {
        //将用户从在线用户列表删除
        if(onlineUsers.hasOwnProperty(socket.name)){
            //退出的用户信息
            var obj = {userid:socket.name, username:onlineUsers[socket.name]};
            //删除
            delete onlineUsers[socket.name];
            //在线人数
            onlineCount--;
            //向所有客户端广播用户退出
            io.emit('logout', {onlineUsers:onlineUsers, onlineCount:onlineCount, user:obj});
            client.set('onlineUser',JSON.stringify(onlineUsers), function (err, res) {
                if(err){
                    console.log(err);
                } else {
                    console.log(res);
                }
            });
            console.log(obj.username+'退出了');
        }
    })
});