
        var express = require('express');
        var app = express();
        // 固定写法
        var http = require('http').Server(app);
        var io = require('socket.io')(http);

        app.set('view engine', 'ejs');
        app.use(express.static('./public'));

        // 聊天室
        app.get('/', function(req,res){
            res.render('index', {
                'ip' : req.ip
            });
        });

        // socket.io 监听 全双工实时通讯 广播
        io.on('connection', function(socket){
            // 接收外部传来的信息
            socket.on('clientOut', function(clientMsg){
                console.log(clientMsg);
                // 把接收到的信息, 原样的广播给所有连接的用户
                io.emit('serverOut', clientMsg);
            })
        });

        http.listen(3000);
