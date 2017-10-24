<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Consultation extends Base
{
    /**
     * 显示聊天页面
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('index/index');
    }
}
