<?php
namespace app\index\controller;
use app\index\model\Pay;
use think\Db;
require './Wxpay/lib/WxPay.Api.php';
error_reporting(0);
class weixinplay extends \think\Controller
{
    public function index()
    {
        $data = cache('hotel_order');
        $this->assign('data',$data);
        return view('index/weixinplay');
    }

    public function goods()
    {
        $data = cache('data');
        return view('index/weixinplay', [
            'data'=>$data,
        ]);
    }

    public function weixin()
    {//发起微信支付，得到微信支付字符串，直接输出字符串，在模板中通过jquery生成支付二维码
        $data = input();

        if(request()->isPost()){
            $Pay = new Pay;
            $result = $Pay->weixin([
                'body' => input('post.body/s','','trim,strip_tags'),
                'attach' => input('post.attach/s','','trim,strip_tags'),
                'out_trade_no' => input('post.orderid/s','','trim,strip_tags'),
                'total_fee' => input('post.total_fee/f',0,'trim,strip_tags')*100,//订单金额，单位为分，如果你的订单是100元那么此处应该为 100*100
                'time_start' => date("YmdHis"),//交易开始时间
                'time_expire' => date("YmdHis", time() + 604800),//一周过期
                'goods_tag' => '在线充值余额',
                'notify_url' => request()->domain().url('index/weixinplay/weixin_notify'),
                'trade_type' => 'NATIVE',
                'product_id' => rand(1,999999),
            ]);

            // var_dump($result);
            // die;
            if(!$result['code']){
                return $this->error($result['msg']);
            }
            return $this->success($result['msg']);
        }
        $this->view->orderid = date("YmdHis").rand(100000,999999);
        return $this->fetch();
    }

    public function weixin_notify()
    {//
         // $out_trade_no = $_POST['out_trade_no'];
        $post=input();
        $out_trade_no=$post['orderid'];
        if(isset($out_trade_no) && $out_trade_no != ""){
            $input = new \WxPayOrderQuery();
            $input->SetOut_trade_no($out_trade_no);
            $result  = \WxPayApi::orderQuery($input);
            /*判断是否支付成功*/
            switch ($result["trade_state"])
            {
                case SUCCESS:
                $res = Db::name('hotel_order')->where('o_order_num',$out_trade_no)->update(['o_status'=>'1']);
                $res1 = Db::name('order')->where('o_order_num',$out_trade_no)->update(['o_status'=>'1']);
                if($res>0 || $res1>0){
                    $info['status']=true;
                    $info['msg']='支付成功';
                    return json($info);
                }
                    
                    break;
                case REFUND:
                     $info['status']=false;
                    $info['msg']='超时关闭订单';
                    return json($info);
                    break;
                case CLOSED:
                    $info['status']=false;
                    $info['msg']='超时关闭订单';
                    return json($info);
                    break;
                case PAYERROR:
                     $info['status']=false;
                    $info['msg']='支付失败';
                    return json($info);
                    break;
            }
    }
}

}