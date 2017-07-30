<?php
namespace app\index\controller;

use think\Url;

class Index
{
    public function index()
    {
        //echo time();
        return view('index/index');
    }


}
