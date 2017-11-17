<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use lib\page;
use phpmailer\phpmailer;
//use app\admin\controller\Page;

class Users extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //加载模板
        $sql='select * from ml_user LEFT JOIN ml_user_detail ON ml_user.u_id=ml_user_detail.ud_uid';
        $list=Db::query($sql);
       // dump($list);

        //分页
        //$data = count($list);
       $p = new Page($list,5);
        //exit();
       // dump($p);
       //die;
        return view('users/index',['p'=>$p]);
    }

    /**
     * 保存更新的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function update($id)
    {
        $data = ['is_comment'=>'1'];
        $result = Db::name('user')->where('u_id',$id)->update($data);
        //dump($result);
       //exit;
       if ($result) {
           $info['status'] = true;
           $info['id'] = $id;
           $info['info'] = '已限制此用户的评论功能';
       } else {
            $info['status'] = false;
            $info['id'] = $id;
           $info['info'] = '禁言失败,请刷新重试!';
       }
       return json($info);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result = Db::name('user')->delete($id);

        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '此用户已被删除';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '用户删除失败,请重试!';
        }
        return json($info);
    }
    /**
     * 显示单条数据.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $sql='select * from ml_user LEFT JOIN ml_user_detail ON ml_user.u_id=ml_user_detail.ud_uid where u_id='.$id;
        $result = Db::query($sql);

        //查看此用户的总订单量
        $o=Db::name('order')->where('o_uid',$id)->select();
        $o_num=count($o);

        $sum=0;
        //查看总消费金额
        foreach($o as $val){
            $sum+=$val['o_total'];
        }
        $result[0]['num']=$o_num;
        $result[0]['sum']=$sum;

        //var_dump($result);
        if ($result) {
            $result['status'] = true;

        } else {
            $result['status'] = false;
        }

        return json($result);

    }
    public function email($id)
    {
        $sql='select ml_user.u_username,ml_user_detail.ud_photo,qqphoto,ud_email from ml_user LEFT JOIN ml_user_detail ON ml_user.u_id=ml_user_detail.ud_uid where u_id='.$id;
        $result = Db::query($sql);
        if ($result) {
            $result['status'] = true;
        } else {
            $result['status'] = false;
        }
        return json($result);
    }
    //发送邮件
    public function send()
    {
        $email = input('email');//定义收件人的邮箱
        $textarea=input('content');
       //dump($textarea);die;
        $mail = new PHPMailer(); //建立邮件发送类
        $mail->CharSet = "UTF-8";
        $address ="13127573831@163.com";
//        $address ="695260422@qq.com";
        $mail->IsSMTP(); // 使用SMTP方式发送
//        $mail->Host = "smtp.qq.com";
        $mail->Host = "smtp.163.com";
        $mail->SMTPAuth = true; // 启用SMTP验证功能
        $mail->Username = "13127573831@163.com";
//        $mail->Username = "695260422@qq.com";
//        $mail->Password = "shanshan123";
        $mail->Password = "shanshan123";
        $mail->Port=25;
        $mail->From = "13127573831@163.com"; //邮件发送者email地址
        $mail->FromName = "美丽乡村";
        $mail->AddAddress($email, "美丽乡村");
        $mail->AddReplyTo("13127573831@163.com", "美丽乡村");//设置回复人信息
        $mail->IsHTML(true); //是否使用HTML格式

        $mail->Subject = "美丽乡村"; //邮件标题
        $mail->Body = $textarea; //邮件内容，上面设置HTML，则可以是HTML
        if(!$mail->Send())
        {
            $this->error('发送失败,请重试');
//                echo "错误原因: " . $mail->ErrorInfo;
//                exit;
        }else{
            $this->success('邮件已成功发送');
        }
    }
}
