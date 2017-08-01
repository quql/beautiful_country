<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class BusRegister extends Controller
{
    /**
     * 保存注册信息
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function doRegister(Request $request)
    {
        //处理接收到的数据
        $info = $request->post();
        //dump($info);

        //判断店铺名字和手机号的唯一
        $res = Db::name('business')->where('b_name', $info["b_name"])->find();
        //dump($res);
        if ($res !== null) {
            $this->error('此商铺名称已有人注册啦,请修改~~~');
        }
        $a = Db::name('business')->where('b_phone', $info["b_phone"])->find();
        if ($a !== null) {
            $this->error('手机号码重复啦,请修改~~~~');
        }
        //整理添加的数组信息
        $adress = explode('/', $info['adress']);
        $date = date('Y-m-d H:i:s');
        $data = [
            'b_type' => $info['b_type'],
            'b_username' => $info['b_username'],
            'b_name' => $info['b_name'],
            'b_password' => md5($info['b_password']),
            'b_phone' => $info['b_phone'],
            'b_province' => $adress['0'],
            'b_city' => $adress['1'],
            'b_area' => $adress['2'],
            'b_create_time' => $date,
            'is_approve' => 'N'
        ];
        //添加进数据库
        $result = Db::name('business')->data($data)->insert();
        //dump($result);
        if ($result > 0) {
            //如果添加成功 重定向到首页
            $this->success('申请已成功提交,我司会在三个工作日内审核并通知结果,请耐心等待,O(∩_∩)O谢谢', '/');
        } else {
            //失败则回到注册页 自动触发一次注册按钮
            $this->error('(⊙o⊙)网络异常,提交失败,请重新提交,谢谢!');
        }


    }
}
