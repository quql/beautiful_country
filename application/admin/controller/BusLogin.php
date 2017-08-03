<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class BusLogin extends Controller
{
    /**
     * 显示商家登录页面
     *
     * @return \think\Response
     */
    public function index()
    {
        //加载商家登陆的模板
        return view('login/busLogin');

    }


    /**
     * 执行商家登陆的操作
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function doLogin(Request $request)
    {
        //处理表单数据
        $info = $request->post();
        //dump($info);
        //判断数据是否合法
        //dump($res);
        $res = Db::name('business')->where('b_name', $info["b_name"])->find();
        if ($res === null) {
            $this->error('啊偶~~~商铺不存在哦~~~去首页注册开店吧', '/');
        } elseif (md5($info['pass']) !== $res['b_password']) {
            $this->error('密码有误,请重新输入');
        } elseif ($res['is_approve'] == 'N') {
            $this->error('店铺尚未审核通过,请耐心等待,O(∩_∩)O谢谢!!!');
        } else {
            //把b_name保存在缓存中 使用助手函数 cache
            $options = [
                // 缓存类型为redis
                'type' => 'redis',
                'host' => '127.0.0.1',
                // 默认缓存有效期为永久有效
                'expire' => 0,
                // 指定缓存目录
                'path' => APP_PATH . 'runtime/cache/',
            ];
            //初始化缓存
            cache($options);
            $b_id=$res['b_id'];
            //设置缓存
            cache('b_name', $res['b_name'], 7200);
            cache('b_id', $b_id, 7200);
            //dump(cache('b_name'));
            $this->success('登陆成功','admin/BusIndex/index');
        }
    }

    /**
     * 执行商家退出的操作
     * @return \think\Response
     * @internal param Request $request
     */
    public function loginOut(Request $request)
    {
        //清空缓存
        cache('b_name', NULL);
        cache('b_id', NULL);
        $this->success('已安全退出', 'admin/BusLogin/index');

    }


}
