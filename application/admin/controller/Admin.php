<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Admin extends Controller
{
    public function _initialize(){
        if(empty(input('session.admin_id'))){
            //跳转到 登陆页
            $this->redirect("admin/login/index");
        }

        $login_session=input('session.');
        $login_id = $login_session['admin_id'];
        // var_dump($id);
        $login_data=Db::table('ml_admin_user')->where('id',$login_id)->select();
        $login_role = $login_data['0']['role'];
        $login_role = Db::table('ml_role')->where('id',$login_role)->select();
        $myrole = $login_role['0']['name'];
        $this->assign('title','美丽乡村后台管理系统');
        $this->assign('login_role',$myrole);
        $this->assign('login_data',$login_data);

        $request = \think\Request::instance();
        $controller = $request->controller(); //获取控制器名
        $action = $request->action(); //获取方法名
//        var_dump($controller,$action);
//        die;
        $id = input('session.admin_id');
        $a = Db::table('ml_admin_user')->where('id',$id)->select();
        $role = $a['0']['role'];

        $node = Db::table('ml_role_node')->field('nid')->where('rid',$role)->select();
//        var_dump($node);
//        die;
        $controllera=array();
        $actiona=array();
        foreach($node as $key=>$v) {
            $n = Db::table('ml_node')->field('controller,action')->where('id',$v['nid'])->select();
//           var_dump($n);
            array_push($controllera,$n['0']['controller']);
            array_push($actiona,$n['0']['action']);
        }
//        var_dump($node);
//
//        var_dump($role);
//        exit;
        if($role!==1 ){
            if(!in_array($controller,$controllera) || !in_array($action,$actiona)){
                $this->error('您没有此权限');
            }
        }


    }

}
