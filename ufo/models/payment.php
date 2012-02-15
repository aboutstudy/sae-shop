<?php
class Payment extends AppModel{
	var $name = 'Payment';
	var $useTable = false;
	
	/**
	 * 返回支付宝接口配置
	 */
	public function aliConfig(){
		//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
		//合作身份者ID，以2088开头的16位纯数字
		$return['partner']		= "2088502555883595";
		
		//安全检验码，以数字和字母组成的32位字符
		$return['key']			= "jxdurum7mz6mj0lzenirbx496r8ynvzu";
		
		//签约支付宝账号或卖家支付宝帐户
		$return['seller_email']	= "pay@doucl.com";
		
		//交易过程中服务器通知的页面 要用 http://格式的完整路径，不允许加?id=123这类自定义参数
		$return['notify_url']	= 'http://' . $_SERVER['HTTP_HOST'] . '/Payment/aliNotify';
		
		//付完款后跳转的页面 要用 http://格式的完整路径，不允许加?id=123这类自定义参数
		//return_url的域名不能写成http://localhost/js_php_utf8/return_url.php ，否则会导致return_url执行无效
		$return['return_url']	= 'http://'.$_SERVER['HTTP_HOST'] . '/Payment/aliResponse';
//		$return['return_url']	= 'http://'.$_SERVER['HTTP_HOST'] . '/payment/ali_return.php';
		
		//网站商品的展示地址，不允许加?id=123这类自定义参数
		$return['show_url']		= 'http://'.$_SERVER['HTTP_HOST'] . '/mall/';
		
		//收款方名称，如：公司名称、网站名称、收款人姓名等
		$return['mainname']		= "豆壳商城";
		
		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		
		
		
		//签名方式 不需修改
		$return['sign_type']		= "MD5";
		
		//字符编码格式 目前支持 GBK 或 utf-8
		$return['_input_charset']	= "utf-8";
		
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$return['transport']		= "http";	

		return $return;
	}
	
	public function getPayName($pay_id){
		$pay_name = '';
		switch($pay_id){
			case 1:
				$pay_name = '支付宝';
				break;
			case 2:
				$pay_name = '财付通';
				break;
			case 3:
				$pay_name = '余额支付';
				break;					
		}
		return $pay_name;
	}
}