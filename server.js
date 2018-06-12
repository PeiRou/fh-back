const app       = require('http'),
    moment      = require('moment'),
    redis       = require("redis"),
    client      = redis.createClient(),
    fs          = require('fs')
;
// let options = {
//
// };
var server = app.createServer(handler);
const  io = require('socket.io')(server);
    client.on("error", function (err) {
        console.log("Error " + err);
    });

server.listen(6003, function () {
        console.log('Server is running!') ;
    });
    function handler(req, res) {
        res.writeHead(200);
        res.end('');
    }


    io.on('connection', function (socket) {

        socket.on('welcome', function (user) {
            io.emit('welcome',user);
        });
        socket.on('message', function (data) {
            var _data = {
                message:data.message,
                imgUrl:data.imgUrl,
                uid:data.uid,
                type:'msg',
                date: moment().format('HH:mm:ss'),
            };
            var txt_data = {
                content:data.message,
                type:'msg',
                sendSrc:data.imgUrl,
                name:data.uid,
                type_left:true,
                type_right:false,
                levelSrc:"/chat/imgs/icon_member03.gif",
                imgSrc:"/chat/imgs/avatar.png",
                date: moment().format('HH:mm:ss'),
            };
            fs.appendFile('messages.txt', JSON.stringify(txt_data)+ '\n',function(err){
                if(err)throw err;
            });

            io.emit('message',_data);
        });
        socket.on('disconnect', function () {
            console.log('user disconnect')
        })
    });

    client.subscribe('chat-system');
    client.subscribe('chat-packet');    //红包频道
    client.subscribe('chat-room');   //聊天室频道
    client.subscribe('open-channel');   //开奖频道

    client.on('message', function(channel, message) {
        let data = JSON.parse(message);
        let txt_data = {};
        if(channel==='chat-packet'){
            txt_data.id   = data.data;
            txt_data.type = 'chat-packet';
            txt_data.date = data.date;
        }
        if(channel==='chat-system'){
            txt_data.content    = data.content;
            txt_data.type       = 'chat-system';
            txt_data.date       = data.date;
            txt_data.schedule   = data.schedule;
        }

        fs.appendFile('messages.txt', JSON.stringify(txt_data)+ '\n',function(err){
            if(err)throw err;
        });
        console.log(channel);
        console.log(data);
        io.emit(channel,data);
    });
