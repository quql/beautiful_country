<?php
namespace app\index\model;
use think\Validate;
use think\Log;
// require './Wxpay/lib/WxPay.Data.php';
require './Wxpay/example/WxPay.NativePay.php';

class Pay extends \think\Model
{
    private function _weixin_config(){//微信支付公共配置函数
        define('WXPAY_APPID', "wx431438b2f0898f24");//微信公众号APPID
        define('WXPAY_MCHID', "1347721901");//微信商户号MCHID
        define('WXPAY_KEY', "123456789012345678901234567890bo");//微信商户自定义32位KEY
        define('WXPAY_APPSECRET', "boyuHotelproducts");//微信公众号appsecret
    }

    public function weixin()
    {//发起微信支付，如果成功，返回微信支付字符串，否则范围错误信息
        $data = input();
        $validate = new Validate([
            ['body','require','请输入订单描述'],
            ['attach','require','请输入订单标题'],
            ['out_trade_no','require|alphaNum','订单编号输入错误|订单编号输入错误'],
            ['total_fee','require|number|gt:0','金额输入错误|金额输入错误|金额输入错误'],
            ['notify_url','require','异步通知地址不为空'],
            ['trade_type','require|in:JSAPI,NATIVE,APP','交易类型错误'],
        ]);
        // if (!$validate->check($data)) {
        //     return ['code'=>0,'msg'=>$validate->getError()];
        // }
        // var_dump($data);
        // die;
        $this->_weixin_config();
        $notify = new \NativePay();
        $input =new \WxPayUnifiedOrder();
        $input->SetBody($data['body']);
        $input->SetAttach($data['attach']);
        $input->SetOut_trade_no($data['orderid']);
        $input->SetTotal_fee('1');
        $input->SetTime_start($data['time_start']);
        $input->SetTime_expire($data['time_expire']);
        $input->SetGoods_tag($data['goods_tag']);
        $input->SetNotify_url("http://qqlongtop/weixinplayover");
        $input->SetTrade_type('NATIVE');
        $input->SetProduct_id($data['orderid']);
        // var_dump($input);
        $result = $notify->GetPayUrl($input);
        // var_dump($result);
        // die;
        if($result['return_code'] != 'SUCCESS'){
            return ['code'=>0,'msg'=> $result['return_msg']];
        }
        if($result['result_code'] != 'SUCCESS'){
            return ['code'=>0,'msg'=> $result['err_code_des']];
        }
        return ['code'=>1,'msg'=>$result["code_url"]];
    }

   
}
?>