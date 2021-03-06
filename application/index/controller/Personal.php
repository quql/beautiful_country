<?php
namespace app\index\controller;


use app\index\model\User;
use think\Controller;
use think\Db;
use think\Request;
use think\db\Query;
use think\Validate;


class Personal extends Base
{
    /**
     * 显示个人中心页面
     *$id,用户id
     * @return \think\Response
     */
    public function index()
    {
        //用户id
        $id = input('session.u_id');
        // var_dump($id);die;
        //获取用户基本信息
        $user = model('user');
        $list = $user->getUser($id);
//        var_dump($list);
//        die;

        $m = model('money');
        $money = $m->getNum($id);
        //dump($money);

        //加载用户收获的地址
        $add = model('userAddress');
        $data = $add->getAddress($id);
        //dump($data);

        //处理订单信息
        $o = model('order');
        //加载未发货订单
        $un = $o->unOrder($id);
        //dump($un);die;

        //加载已发货订单
        $diliver = $o->diliver($id);
        //dump($diliver);

        //加载酒店订单
        $h = model('hotelOrder');
        $hotels = $h->getOrder($id);

        //加载已完成订单
        $done = $o->done($id);

        //加载此用户下的评论内容
        $sql = "select ml_comment.c_score,c_text,c_time,c_gname,c_cid,c_gid,c_bid,c_id,ml_bus_comment.c_content,c_atime FROM ml_comment LEFT JOIN ml_bus_comment ON ml_bus_comment.com_id=ml_comment.c_id WHERE ml_comment.c_uid=$id";
        $comment = Db::query($sql);
        //dump($comment);



        //获取用户参加的活动数据
        $activities_register = Db::name('activities_register')->where('ar_user_id',$id)->select();

        foreach($activities_register as $k=>$v){
            $q = new Query;
            // $n[$k] = $q->name('activities')->field('ac_title')->where('id',$v['ar_activities_id'])->find();
            $activities_register[$k]['qq'] = $q->name('activities')->where('id',$v['ar_activities_id'])->find();
        }
        // var_dump($n);
        // var_dump($activities_register);
        // die;

        return view('index/personal',[
            'list'=>$list,
            'data'=>$data,
            'money'=>$money[0],
            'un'=>$un,
            'diliver'=>$diliver,
            'done'=>$done,
            'hotels'=>$hotels,
            'comment'=>$comment,
            'activities_register'=>$activities_register
        ]);
    }

    /*
     * 修改个人信息
     * */
    public function updateUser()
    {
        $info = input('put.');
        $id = $info['id'];

        $oldcode = $info['oldcode'];
        $newcode = $info['newcode'];
        if($oldcode != $newcode){
            return $this->error('验证码不正确,请重试~');
        }

        $d1 = [
          'u_username'=>$info['u_username'],
          'u_phone'=>$info['u_phone'],
        ];
        $d2 = [
            'ud_sex'=>$info['ud_sex'],
            //'ud_email'=>$info['ud_email'],
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

    //修改用户密码
    public function updatePass()
    {
        $info = input('put.');
        $id = $info['id'];
        //dump($info);

        //后期加上md5
        $oldpass = md5($info['oldpass']);
        //更新的数据必须是数组!
        $secondpass = ['u_password'=>md5($info['secondpass'])];
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
                session('u_id',null);
                return $this->success('密码修改成功!', url('/register'));
            }else{
                return $this->error('密码修改失败,请重试~');
            }
        }else{
            return $this->error('原密码不正确,请重试~');
        }
    }


    //添加收货地址
    public function address()
    {
        $info = input('post.');
        //dump($info);

        $id = $info['id'];

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
    
    //删除用户收获的地址
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
        $id = input('post.')['id'];

        $info = $file->validate(['size'=>156780,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads/headPhoto');
        //if($info){
        //    // 成功上传后 获取上传信息
        //    // 输出 jpg
        //    echo $info->getExtension();
        //    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        //    echo $info->getSaveName();
        //    // 输出 42a79759f284b767dfcb2a0197904287.jpg
        //    echo $info->getFilename();
        //}else {
        //    // 上传失败获取错误信息
        //    echo $file->getError();
        //}
        //die;

        // 移动到框架应用根目录/public/uploads/ 目录下
        //$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/headPhoto');
        ////dump($info);die;
        //$ext = $info->getExtension();
        //$name = str_replace('\\','/',$info->getSaveName());
        ////dump($name);die;
        //$array = array("jpg","png","gif");
        //if(!in_array($ext, $array)){
        //    $path = './uploads/headPhoto/'.$name;
        //    unlink($path);
        //    $this->error('仅能上传图片文件');
        //}



        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            //echo $info->getExtension();
            //echo "<br>";
            //// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getSaveName();
            $old = $info->getSaveName();
            $new = str_replace("\\", "/", $old);
            //dump($new);exit;
            $data = [
                'ud_photo'=>$new,
            ];
            //echo "<br>";
            //// 输出 42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getFilename();
            //echo "<br>";
            //dump($data);exit;

            $img = model('userDetail');
            $res = $img->upPhoto($id, $data);
            if ($res){
                return $this->success('上传成功!', url('index/personal/index'));
            } else {
                return $this->error('上传失败,请重试~');
            }
        }else{
            // 上传失败获取错误信息
            //echo $file->getError();
            return $this->error('上传失败,请重试~');
        }
    }

    //用户个性照片上传
    public function upPic()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        $id = input('post.')['id'];

        $info = $file->validate(['size'=>156780,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads/userPic');
        //if($info){
        //// 成功上传后 获取上传信息
        //// 输出 jpg
        //    echo $info->getExtension();
        //// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        //    echo $info->getSaveName();
        //// 输出 42a79759f284b767dfcb2a0197904287.jpg
        //    echo $info->getFilename();
        //}else {
        //    // 上传失败获取错误信息
        //    echo $file->getError();
        //}
        //die;
        //
        //// 移动到框架应用根目录/public/uploads/ 目录下
        //$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/userPic');
        //$ext = $info->getExtension();
        //$name = str_replace('\\','/',$info->getSaveName());
        ////dump($name);die;
        //$array = array("jpg","png","gif");
        //if(!in_array($ext, $array)){
        //    $path = './uploads/headPhoto/'.$name;
        //    unlink($path);
        //    $this->error('仅能上传图片文件');
        //}

        if($info){
            $old = $info->getSaveName();
            $new = str_replace("\\", "/", $old);
            $data = [
                'ud_picture'=>$new,
            ];

            $img = model('userDetail');
            $res = $img->upPhoto($id, $data);
            if ($res){
                return $this->success('上传成功!', url('index/personal/index'));
            } else {
                return $this->error('上传失败,请重试~');
            }
        }else{
            // 上传失败获取错误信息
            //echo $file->getError();
            return $this->error('上传失败,请重试~');
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

        //更改积分
        $d = model('userDetail');
        //获取原积分
        $point = $d->getPoint($id)['ud_point'];

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
            //dump($num);die;
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

