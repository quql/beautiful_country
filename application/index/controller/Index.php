<?php
namespace app\index\controller;

use think\Controller;
use think\Url;

class Index extends Controller
{
    public function index()
    {
    
        return view('index/index');
    }


}
