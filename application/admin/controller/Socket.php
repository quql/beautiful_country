<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\worker\Server;
use Workerman\Worker;

class Socket extends Server
{
    protected $socket = 'websocket://tp.vip:80';


//    public function index()
//    {
//
//
//        // 创建一个Worker监听2346端口，使用websocket协议通讯
//        $ws_worker = new Worker("websocket://tp.vip:80");
//        dump($ws_worker);
//        // 启动4个进程对外提供服务
//        $ws_worker->count = 4;
//
//        // 当收到客户端发来的数据后返回hello $data给客户端
//        $ws_worker->onMessage = function($connection, $data)
//        {
//            // 向客户端发送hello $data
//            $connection->send('hello ' . $data);
//        };
//
//        // 运行worker
//        Worker::runAll();
//
//    }

    /**
     * 收信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        $connection->send('hello ');
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {
    }
    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
    }
    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }
    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {
    }
}
