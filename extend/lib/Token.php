<?php 
namespace lib;
/**
* 自动获取token
*/
class Token
{
	public static $tokenFile = './token.txt';
	public static $tokenExpireTime = '3600'; 
	// 入口方法  
	public static function getToken()
	{
		if ( !self::checkTokenFileExists() || self::checkTokenFileExpire() ) {
			// 缓存不存在 或者 缓存过期
			
			// 重新获取token
			$res = self::requestToken();
			// 写入缓存
			self::writeToken($res);
			return $res;

		}else{
			// 缓存存在  且 没过期
			return self::readToken();
		}
	}

	// 阿姨我要吃你下面  
	//    -> 阿姨  去揪一把面
	//    	->下面
	//    		-> 捞面
	//    			-> 端给班长吃


	// 请求token
	public static function requestToken()
	{
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxb59dd63466a430aa&secret=69f17dc717e462559000c4309894ec35';

		$res = https_request($url);
		$data = json_decode($res,true);
		// var_dump($data['access_token']);
		if ( !empty($data['access_token']) ) {
			
			return $data['access_token'];
		}else{
			return false;
		}

	}

	// token  有缓存  
	// 得写入缓存 和 读取缓存

	public static function writeToken($token)
	{
		file_put_contents(self::$tokenFile,$token);

	}

	public static function readToken()
	{
		return file_get_contents(self::$tokenFile);
	}

	// token  有效期 两小时
	// 判断缓存是否存在 
	public static function checkTokenFileExists()
	{
		return file_exists(self::$tokenFile);
	}

	// 判断缓存是否过期
	public static function checkTokenFileExpire()
	{
		// 王雪  
		// 	-> 牛奶  2017-07-07生产日期
		// 	  -> 2017-07-10 购买
		// 	  -> 保质期 7天
		// 	  -> 过期 7+7 = 14   07-14号过期
		// 	  
		// 生产日期  +  保质期  < 当前日期   过期   
		
		return filemtime(self::$tokenFile)  +  self::$tokenExpireTime  < time();



	}



	
}






















 ?>