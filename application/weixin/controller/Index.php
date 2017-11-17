<?php
namespace app\weixin\controller;
use lib\wechatCallbackapiTest;
use lib\Token;
use think\Controller;
use think\Url;
use think\Db;

Class Index extends controller
{
    public function index()
    {
         $postStr = file_get_contents('php://input'); 

        file_put_contents('./data.txt',$postStr);
        // $postStr 是xml数据
        // xml 转化为对象
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $fromUsername = $postObj->FromUserName;   // 用户id
        $toUsername = $postObj->ToUserName;       // 商户id
        $keyword = trim($postObj->Content);
        $event = $postObj->EventKey;             // 内容
        $time = time();


        if($event == "V1001_GOOD"){
             $textTpl = '<xml>
                    <ToUserName><![CDATA['.$fromUsername.']]></ToUserName>
                    <FromUserName><![CDATA['.$toUsername.']]></FromUserName>
                    <CreateTime>'.$time.'</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[谢谢您的赞,我们会继续努力!!]]></Content>
                    </xml>';
               echo $textTpl;     
                    exit;
        }
        switch ($keyword) {
    case '1':
            $textTpl = '<xml>
                <ToUserName><![CDATA['.$fromUsername.']]></ToUserName>
                <FromUserName><![CDATA['.$toUsername.']]></FromUserName>
                <CreateTime>'.$time.'</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>1</ArticleCount>
                <Articles>
                <item>
                <Title><![CDATA[美丽乡村风景]]></Title> 
                <Description><![CDATA[稠花乱蕊畏江滨，行步欹危实怕春。诗酒尚堪驱使在，未须料理白头人。]]></Description>
                <PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz_jpg/A2kian6nDkJkBEJNTNJnerDXb6AKpVedW8YSnriciaaO8NpeHk1IJfLLMVZ8yqKNibWqXG6V2AkNKpzmaEPBDG4ibKw/0]]></PicUrl>
                <Url><![CDATA[http://qqlong.top/listshow/cid/1.html]]></Url>
                </item>
                </Articles>
            </xml>';
        break;
         case '2':
        $textTpl = '<xml>
                <ToUserName><![CDATA['.$fromUsername.']]></ToUserName>
                <FromUserName><![CDATA['.$toUsername.']]></FromUserName>
                <CreateTime>'.$time.'</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>1</ArticleCount>
                <Articles>
                <item>
                <Title><![CDATA[美丽乡村酒店]]></Title> 
                <Description><![CDATA[金陵子弟来相送,欲行不行各尽觞。]]></Description>
                <PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz_jpg/A2kian6nDkJkBEJNTNJnerDXb6AKpVedWJm8zib1BLNYjoKvzrrdbG36jApsKhDMxMGl9RC0CA1K3DuLUwnlBvpQ/0]]></PicUrl>
                <Url><![CDATA[http://qqlong.top/listshow/cid/4.html]]></Url>
                </item>
                </Articles>
            </xml>';
        break;
        case '3':
        $textTpl = '<xml>
                <ToUserName><![CDATA['.$fromUsername.']]></ToUserName>
                <FromUserName><![CDATA['.$toUsername.']]></FromUserName>
                <CreateTime>'.$time.'</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>1</ArticleCount>
                <Articles>
                <item>
                <Title><![CDATA[美丽乡村特色美食]]></Title> 
                <Description><![CDATA[简单的食物,本真的生活.]]></Description>
                <PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz_jpg/A2kian6nDkJkBEJNTNJnerDXb6AKpVedWPpaNiaRQNiaUNSo5LibjkdEenzCjgRuGoX85WALYaibMpczicXAibbcUquyw/0]]></PicUrl>
                <Url><![CDATA[http://qqlong.top/listshow/cid/6.html]]></Url>
                </item>
                </Articles>
            </xml>';
        break;
    
    default:
             $textTpl = '<xml>
                <ToUserName><![CDATA['.$fromUsername.']]></ToUserName>
                <FromUserName><![CDATA['.$toUsername.']]></FromUserName>
                <CreateTime>'.$time.'</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>2</ArticleCount>
                <Articles>
                <item>
                <Title><![CDATA[输入1,查看热门景区;输入2,查看酒店;输入3,查看美食]]></Title> 
                <Description><![CDATA[原来不论是月色如水,还是微雨蒙蒙,只 要你心存感动,美丽将永远存在]]></Description>
                <PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz_jpg/A2kian6nDkJkBEJNTNJnerDXb6AKpVedWX7rzaDTupUOglLWaYu5zz18OicgF8ib6YiasicZLQ37rCuoicsXbFHQvE0w/0]]></PicUrl>
                <Url><![CDATA[http://qqlong.top]]></Url>
                </item>
                <item>
                <Title><![CDATA[原来不论是月色如水,还是微雨蒙蒙,只 要你心存感动,美丽将永远存在]]></Title> 
                <Description><![CDATA[原来不论是月色如水,还是微雨蒙蒙,只 要你心存感动,美丽将永远存在]]></Description>
                <PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz_jpg/A2kian6nDkJkBEJNTNJnerDXb6AKpVedWg1m4LpX0Q8KUWPva4xmpFZiaCrjPOqYj4uGdLj6ThPiaPwibHTEUFmib3w/0]]></PicUrl>
                <Url><![CDATA[http://qqlong.top]]></Url>
                </item>
                </Articles>
            </xml>';
       
        break;
}
echo $textTpl;
       

  


        exit;
        define("TOKEN", "country");
        $wechatObj = new wechatCallbackapiTest();
        $wechatObj->valid();
    }
}