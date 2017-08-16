<?php

namespace app\index\controller;


use app\index\model\User;
use think\Controller;
use think\Request;

class Personal extends Controller
{
    /**
     * 显示个人中心页面
     *$id,从session中获取用户id
     * @return \think\Response
     */
    public function index()
    {
        //用户id
//        $id = input('session.uid');
        $id =1;
        //获取用户基本信息
        $user = model('user');
        $list = $user->getUser($id);
        //var_dump($list);
        //die;

        $m = model('money');
        $money = $m->getNum($id);
        $mnu=$money['m_ten']+$money['m_twenty']+$money['m_fifty']+$money['m_hundred'];
        //dump($money);

        //处理订单信息
        $o = model('order');
        //加载未发货订单
        $un = $o->unOrder($id);
        //dump(count($un));

        //加载已发货订单
        $diliver = $o->diliver($id);
        //dump($diliver);

        //加载已完成订单
        $done = $o->done($id);
        //dump($done);
      return view('buy/personal1',[
            'list'=>$list,
            'mnu'=>$mnu,
            'wnu'=>count($un),
            'snu'=>count($diliver),
            'dnu'=>count($done)
        ]);
    }

    /*
     * 显示优惠券
     * */
    public function coupon()
    {
        //用户id
//        $id = input('session.uid');
        $id =1;

        $m = model('money');
        $money = $m->getNum($id);
        //dump($money);

        return view('buy/coupon',[
            'money'=>$money
        ]);
    }

    /*
     * 加载修改信息的页面
     * */
    public function baseinfo()
    {
        //用户id
//        $id = input('session.uid');
        $id =1;
        //获取用户基本信息
        $user = model('user');
        $list = $user->getUser($id);
        //var_dump($list);
        return view('buy/baseinfo',[
            'info'=>$list
        ]);
    }
    /*
     * 显示订单状态的信息
     * */
    public function order()
    {
//        $id = input('session.uid');
        $id=1;
        //处理订单信息
        $o = model('order');
        //加载未发货订单
        $un = $o->unOrder($id);
        //dump($un);

        //加载已发货订单
        $diliver = $o->diliver($id);
        //dump($diliver);

        //加载已完成订单
        $done = $o->done($id);

        return view('buy/order',[
            'un'=>$un,
            'diliver'=>$diliver,
            'done'=>$done
        ]);
    }

    /*
     * 修改个人信息
     * */
    public function updateUser()
    {
        $info = input('put.');
        $id = $info['id'];
        //dump($info
        //exit;);
        $d1 = [
          'u_username'=>$info['u_username'],
          'u_phone'=>$info['u_phone'],
        ];
        $d2 = [
            'ud_sex'=>$info['ud_sex'],
            'ud_email'=>$info['ud_email'],
        ];

        $user = model('user');
        $r1 = $user->updateUser($id, $d1);

        $detail = model('userDetail');
        $r2 = $detail->updateDetail($id, $d2);

        if ($r1 && $r2){
            return $this->success('修改成功!', url('index/personal/index'));
        } else {
            return $this->error('修改失败,请重试~');
            //echo User::getLastSql();
        }
    }

    /*
     * 加载重置密码的页面
     * */
    public function repass()
    {
        //用户id
//        $id =  input('session.uid');
        $id =1;
        //获取用户基本信息
        $user = model('user');
        $list = $user->getUser($id);
        //var_dump($list);
        return view('buy/repass',[
            'info'=>$list
        ]);
    }
    /*
     * 加载收藏的页面
     * */
    public function favorite()
    {
        //用户id
//        $id = input('session.uid');
        $id =1;
        //获取用户基本信息
//        $user = model('user');
//        $list = $user->getUser($id);
        //var_dump($list);
        return view('buy/favorite',[

        ]);
    }

    //修改用户密码
    public function updatePass()
    {
        $info = input('put.');
        $id = $info['id'];
        //dump($info);

        //后期加上md5
        $oldpass = $info['oldpass'];
        //更新的数据必须是数组!
        $secondpass = ['u_password'=>$info['secondpass']];
        //查询原密码
        $user = model('user');
        $pass = $user->getPass($id)['u_password'];
        //dump($pass);
        //dump($oldpass);

        //匹配
        if ($oldpass === $pass){
            //修改
            $res = $user->updatePass($id, $secondpass);

            if ($res){
                return $this->success('密码修改成功!', url('index/personal/index'));
            }else{
                return $this->error('密码修改失败,请重试~');
            }
        }else{
            return $this->error('原密码不正确,请重试~');
        }
    }

    //显示地址列表
    public function adress()
    {
        //用户id
//        $id = input('session.uid');
        $id =1;
        //加载用户收获的地址
        $add = model('userAddress');
        $data = $add->getAddress($id);
        //dump($data);
        return view('buy/adress',[
            'data'=>$data
        ]);

    }


    //添加收货地址
    public function address()
    {
        //用户id
//        $id = input('session.uid');
        $id =1;
        $info=input('post.');

        $data = [
          'ua_uid'=>$id,
          'ua_name'=>$info['addname'],
          'ua_address'=>$info['address'],
          'ua_street'=>$info['street'],
          'ua_phone'=>$info['addphone'],
        ];

        $user = model('userAddress');
        $res = $user->add($data);
        //
        //dump($id);
        //dump($data);

        if ($res){
            return $this->success('添加地址成功!', url('index/personal/index'));
        } else {
            return $this->error('修改失败,请重试~');
            //echo User::getLastSql();
        }
    }
    
    //删除收货的地址
    public function delAddress()
    {
        $id = input('param.')['id'];
        //dump($id);exit;

        $user = model('userAddress');
        $res = $user->del($id);

        if ($res){
            return $this->success('删除成功!', url('index/personal/index'));
        } else {
            echo User::getLastSql();
            //return $this->error('删除失败,请重试~');
        }
    }
    
    //用户头像上传
    public function upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
//        $id = input('post.')['id'];
        $id =1;
        //dump($id);
        //exit;
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/headPhoto');
        if($info){
            $old = $info->getSaveName();
            $new = str_replace("\\", "/", $old);
            //dump($new);exit;
            $data = [
                'ud_photo'=>$new,
            ];
            //dump($data);exit;

            $img = model('userDetail');
            $res = $img->upPhoto($id, $data);
            if ($res){
                return $this->success('上传成功!',url('index/personal/index'));
            } else {
                return $this->error('更新失败,请重试~');
            }
        }else{
            return $this->error('更新失败,请重试~');
        }
    }


    //确认用户输入密码
    public function checkpass()
    {
        //用户id
        $id = input('post.')['id'];
        //$p = input('post.')['pass'];
        //代金券类型
        $type = input('post.')['type'];
        //代金券数量
        $n = input('post.')['n'];
        //消耗积分
        $total = input('post.')['total'];

        //$user = model('user');
        //$pass = $user->getPass($id)['u_password'];


        //if ($p == $pass){
        //更改积分
        $d = model('userDetail');
        //获取原积分
        $point = $d->getPoint($id);
        $point = $point['ud_point'];

        //减去消耗的积分
        $p = $point - $total;
        $p1 = [
                'ud_point'=>$p
            ];
        //更改积分数据
        $pres = $d->updateDetail($id, $p1);


        $m = model('money');

        if($type == 10){
            //获取代金券信息
            $num = $m->getNum($id, 'm_ten');
            $num1 = $num[0]['m_ten'];
            $rn = $num1 + $n;
            //return json($rn);exit;
            $data = [
                  'm_ten'=>$rn
                ];
                $mres = $m->updateNum($id, $data);
            }elseif($type == 20){
                //获取代金券信息
                $num = $m->getNum($id, 'm_twenty');
                $num1 = $num[0]['m_twenty'];
                $rn = $num1 + $n;
                $data = [
                    'm_twenty'=>$rn
                ];
                $mres = $m->updateNum($id, $data);
            }elseif($type == 50){
                //获取代金券信息
                $num = $m->getNum($id, 'm_fifty');
                $num1 = $num[0]['m_fifty'];
                $rn = $num1 + $n;
                $data = [
                    'm_fifty'=>$rn
                ];
                $mres = $m->updateNum($id, $data);
            }elseif($type == 100){
                //获取代金券信息
                $num = $m->getNum($id, 'm_hundred');
                $num1 = $num[0]['m_hundred'];
                $rn = $num1 + $n;
                $data = [
                    'm_hundred'=>$rn
                ];
                $mres = $m->updateNum($id, $data);
            }

            if ($mres){
                $info['status'] = true;
            }else{
                $info['status'] = false;
            }
            return json($info);
        //}else{
        //    return $this->error('密码不正确,请重试~');
        //}


    }
}

