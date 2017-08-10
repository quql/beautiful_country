<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Url;
use think\Db;
use phpmailer\phpmailer;

class Index extends Base
{
    public function index()
    {
        //查询轮播图
        $pic=Db::name('pic')->where('is_show','1')->select();
        //查询特产美食数据
        $sql="select ml_food.*,ml_food_pic.pic,ml_business.b_name from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid LEFT JOIN ml_business ON ml_food.bus_id=ml_business.b_id  where ml_food_pic.is_first='1' and  ml_food.gd_is_sale='1'";
        $food=Db::query($sql);
        //dump($food);
        //exit;

        return view('index/index',[
            'foods'=>$food,
            'pics'=>$pic
        ]);
    }

    public function loginout()
    {
       session('u_id',null);
       $this->success('退出成功','index/index/index');
    }

    //显示列表页
    public function read($id)
    {
        //判断用户查看的类型
        if($id==4){
            //查询主表字段和封面图片
           $list = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1'");
        }elseif($id==5){
            $list = Db::query("select ml_route.id,gd_title,gd_abstract,price,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1'");
        }elseif($id==1){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1'");
        }elseif($id==6){
            $list = Db::query("select ml_food.id,gd_title,gd_abstract,price,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1'");
        }else{
            return '暂无数据';
        }
//        var_dump($list);
//        die;
        $this->assign('list',$list);
        return view ('index/list');
    }


    public function search(Request $request)
    {
        $data=$request->post('search');
        if(empty($data)){
            $data = 'sadaddadadadada536746 gewafd';
        }

        static $arr=array();
        $arr1 = Db::name('hotel')
                 ->field('id,gd_title,c_id')
                 ->where("gd_title",'like',"%$data%")
                 ->select();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr2 = Db::name('food')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr3 = Db::name('route')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr4 = Db::name('scenery')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $arr[]=$v;
            }
        }
        //var_dump($arr);
        return json($arr);
    }//

    //显示不同分类的商品列表
    //显示列表页
    public function listshow()
    {
        $data =input();
        $id = $data['id'];
        $cateid = $data['cid'];

       // 判断用户查看的类型
        if($id==4){
            //查询主表字段和封面图片
            $list = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.h_cate={$cateid}");
        }elseif($id==5){
            $list = Db::query("select ml_route.id,gd_title,gd_abstract,price,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.h_cate={$cateid}");
        }elseif($id==1){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.h_cate={$cateid}");
        }elseif($id==6){
            $list = Db::query("select ml_food.id,gd_title,gd_abstract,price,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.h_cate={$cateid}");
        }else{
            return '暂无数据';
        }
//        var_dump($list);
//        die;
        $this->assign('list',$list);
        return view ('index/list');
    }

//搜索触发
    public function souover()
    {

        $data=input('search');

        if(empty($data)){
           $this->redirect('index/index/index');
        }

            //查询主表字段和封面图片
            $arr1 = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.gd_title like '%$data%' ");

            $arr2 = Db::query("select ml_route.id,gd_title,gd_abstract,price,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.gd_title like '%$data%' ");

            $arr3 = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_title like '%$data%' ");

            $arr4 = Db::query("select ml_food.id,gd_title,gd_abstract,price,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.gd_title like '%$data%' ");

        static $list=array();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $list[]=$v;
            }
        }

        $this->assign('list',$list);
        return view ('index/list');
    }//

    public function searchover()
    {

        $data=input('search');

        if(empty($data)){
            $data = 'sadaddadadadada536746 gewafd';
        }

        //查询主表字段和封面图片
        $arr1 = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.gd_title like '%$data%' ");

        $arr2 = Db::query("select ml_route.id,gd_title,gd_abstract,price,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.gd_title like '%$data%' ");

        $arr3 = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_title like '%$data%' ");

        $arr4 = Db::query("select ml_food.id,gd_title,gd_abstract,price,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.gd_title like '%$data%' ");

        static $list=array();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $list[]=$v;
            }
        }

        $this->assign('list',$list);
        return view ('index/list');
    }//

    public function email()
    {
        $toemail = 'xxx@qq.com';//定义收件人的邮箱

        $mail = new PHPMailer(); //建立邮件发送类
        $mail->CharSet = "UTF-8";
        $address ="13127573831@163.com";
        $mail->IsSMTP(); // 使用SMTP方式发送
        $mail->Host = "smtp.163.com"; // 您的企业邮局域名
        $mail->SMTPAuth = true; // 启用SMTP验证功能
        $mail->Username = "13127573831@163.com"; // 邮局用户名(请填写完整的email地址)
        $mail->Password = "shanshan123"; // 邮局密码
        $mail->Port=25;
        $mail->From = "13127573831@163.com"; //邮件发送者email地址
        $mail->FromName = "在线Q聊";
        $mail->AddAddress($toemail, "邮箱测试");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
        //$mail->AddReplyTo("", "");//设置回复人信息

        //$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
        $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式

        $mail->Subject = "邮箱测试"; //邮件标题
        $mail->Body = "您的验证码是:8888 "; //邮件内容，上面设置HTML，则可以是HTML

        if(!$mail->Send())
        {
            echo "邮件发送失败. <p>";
            echo "错误原因: " . $mail->ErrorInfo;
            exit;
        }else{
            echo '发送成功';
        }
    }
}
