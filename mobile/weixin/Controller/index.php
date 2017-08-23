<?php
namespace app\weixin\controller;
use lib\wechatCallbackapiTest;
use think\Controller;
use think\Url;
use think\Db;

Class Index extends controller
{
    public function index()
    {
        define("TOKEN", "sao");
        $wechatObj = new wechatCallbackapiTest();
        $wechatObj->valid();
    }
}