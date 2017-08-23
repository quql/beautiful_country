<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Map extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $area = input('area');
        return view('index/map', [
            'area'=>$area,
        ]);
    }


}
