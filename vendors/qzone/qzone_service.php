<?php
/**
 * QQ连接类
 */
require_once('qzone_utils.php');

class QzoneService {
	
	/**
	 * @brief 跳转到QQ登录页面.请求需经过URL编码，编码时请遵循 RFC 1738
	 *
	 * @param $appid
	 * @param $appkey
	 * @param $callback
	 *
	 * @return 返回字符串格式为：oauth_token=xxx&openid=xxx&oauth_signature=xxx&timestamp=xxx&oauth_vericode=xxx
	 */
	function redirect_to_login($appid, $appkey, $callback){
	    //跳转到QQ登录页的接口地址, 不要更改!!
	    $redirect = "http://openapi.qzone.qq.com/oauth/qzoneoauth_authorize?oauth_consumer_key=$appid&";
	
	    //调用get_request_token接口获取未授权的临时token
	    $result = array();
	    $request_token = $this->get_request_token($appid, $appkey);
	    parse_str($request_token, $result);
	
	    //request token, request token secret 需要保存起来
	    //在demo演示中，直接保存在全局变量中.
	    //为避免网站存在多个子域名或同一个主域名不同服务器造成的session无法共享问题
	    //请开发者按照本SDK中comm/session.php中的注释对session.php进行必要的修改，以解决上述2个问题，
	//    $_SESSION["token"]        = $result["oauth_token"];
	//    $_SESSION["secret"]       = $result["oauth_token_secret"];
		$_SESSION["token"]        = $result["oauth_token"];
	    $_SESSION["secret"]       = $result["oauth_token_secret"];
	
	    if ($result["oauth_token"] == ""){
	        //示例代码中没有对错误情况进行处理。真实情况下网站需要自己处理错误情况
	        exit;
	    }
	
	    ////构造请求URL
	    $redirect .= "oauth_token=".$result["oauth_token"]."&oauth_callback=".rawurlencode($callback);
	    header("Location:$redirect");
	}
	 /**
	 * @brief 请求临时token.请求需经过URL编码，编码时请遵循 RFC 1738
	 *  
	 * @param $appid
	 * @param $appkey
	 *
	 * @return 返回字符串格式为：oauth_token=xxx&oauth_token_secret=xxx
	 */
	function get_request_token($appid, $appkey){
	    //请求临时token的接口地址, 不要更改!!
	    $url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token?";
	
	
	    //生成oauth_signature签名值。签名值生成方法详见（http://wiki.opensns.qq.com/wiki/【QQ登录】签名参数oauth_signature的说明）
	    //（1） 构造生成签名值的源串（HTTP请求方式 & urlencode(uri) & urlencode(a=x&b=y&...)）
		$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token")."&";
	
		//必要参数
	    $params = array();
	    $params["oauth_version"]          = "1.0";
	    $params["oauth_signature_method"] = "HMAC-SHA1";
	    $params["oauth_timestamp"]        = time();
	    $params["oauth_nonce"]            = mt_rand();
	    $params["oauth_consumer_key"]     = $appid;
	
	    //对参数按照字母升序做序列化
	    $normalized_str = get_normalized_string($params);
	    $sigstr        .= rawurlencode($normalized_str);
	   
		
		//（2）构造密钥
	    $key = $appkey."&";
	
	
	 	//（3）生成oauth_signature签名值。这里需要确保PHP版本支持hash_hmac函数
	    $signature = get_signature($sigstr, $key);
	    
			
		//构造请求url
	    $url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);
	
	    //echo "$sigstr\n";
	    //echo "$url\n";
	
	    return file_get_contents($url);
	}	
	
	/**
	 * @brief 获取access_token。请求需经过URL编码，编码时请遵循 RFC 1738
	 *
	 * @param $appid
	 * @param $appkey
	 * @param $request_token
	 * @param $request_token_secret
	 * @param $vericode
	 *
	 * @return 返回字符串格式为：oauth_token=xxx&oauth_token_secret=xxx&openid=xxx&oauth_signature=xxx&oauth_vericode=xxx&timestamp=xxx
	 */
	
	function get_access_token($appid, $appkey, $request_token, $request_token_secret, $vericode){
	    //请求具有Qzone访问权限的access_token的接口地址, 不要更改!!
	    $url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token?";
	   
	    //生成oauth_signature签名值。签名值生成方法详见（http://wiki.opensns.qq.com/wiki/【QQ登录】签名参数oauth_signature的说明）
	    //（1） 构造生成签名值的源串（HTTP请求方式 & urlencode(uri) & urlencode(a=x&b=y&...)）
		$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token")."&";
	
	    //必要参数，不要随便更改!!
	    $params = array();
	    $params["oauth_version"]          = "1.0";
	    $params["oauth_signature_method"] = "HMAC-SHA1";
	    $params["oauth_timestamp"]        = time();
	    $params["oauth_nonce"]            = mt_rand();
	    $params["oauth_consumer_key"]     = $appid;
	    $params["oauth_token"]            = $request_token;
	    $params["oauth_vericode"]         = $vericode;
	
	    //对参数按照字母升序做序列化
	    $normalized_str = get_normalized_string($params);
	    $sigstr        .= rawurlencode($normalized_str);
	
	    //echo "sigstr = $sigstr";
	
		//（2）构造密钥
	    $key = $appkey."&".$request_token_secret;
	
		//（3）生成oauth_signature签名值。这里需要确保PHP版本支持hash_hmac函数
	    $signature = get_signature($sigstr, $key);
	    
		
		//构造请求url
	    $url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);
	
	    return file_get_contents($url);
	}
	
	 /*
	 * @brief 获取用户信息.请求需经过URL编码，编码时请遵循 RFC 1738
	 * 
	 * @param $appid
	 * @param $appkey
	 * @param $access_token
	 * @param $access_token_secret
	 * @param $openid
	 *
	 */
	function get_user_info($appid, $appkey, $access_token, $access_token_secret, $openid){
		//获取用户信息的接口地址, 不要更改!!
	    $url    = "http://openapi.qzone.qq.com/user/get_user_info";
	    $info   = do_get($url, $appid, $appkey, $access_token, $access_token_secret, $openid);
	    $arr = array();
	    $arr = json_decode($info, true);
	
	    return $arr;
	}	
}