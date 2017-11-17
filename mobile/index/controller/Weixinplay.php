<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Weixinplay extends Base
{
    public function index()
    {
        return view('index/weixinplay'); 
    }
    
}