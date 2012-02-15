<?php
class PaymentController extends AppController{
	var $uses = array('MallOrder', 'MallGoods', 'MallOrderGoods');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*'); 
	}	
	
	/**
	 * 支付宝支付响应
	 */
	public function aliResponse(){	    
		//加载支付模块
		App::import('Vendor', 'alipay/alipay_notify');
		
		//加载配置信息
		$this->loadModel('Payment');
		$ali = $this->Payment->aliConfig();		

		//构造通知函数信息
		$alipay = new alipay_notify($ali['partner'], $ali['key'], $ali['sign_type'], $ali['_input_charset'], $ali['transport']);
		
		//计算得出通知验证结果
		
		//针对CakePHP路径问题处理$_GET['url']项，暂时只做此处理，可能还有其他额外KEY需要处理
		if(isset($_GET['url'])){
			unset($_GET['url']);
		}	
		$verify_result = $alipay->return_verify();
		
		if($verify_result){//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
		    $order_sn           = $_GET['out_trade_no'];    //获取订单号
		    $total_fee          = $_GET['total_fee'];	    //获取总价格,即总支付金额
		    $pay_trade_no		= $_GET['trade_no'];		//支付交易编号
		    
		    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
					
					//订单状态：0-未确认；1-已确认；2-已取消；3-无效；4-退货；
					//支付状态；0-未付款；1-付款中；2-已付款
					$order = $this->MallOrder->findByOrderSn($order_sn);					
					if($order['MallOrder']['order_status'] <= 1 AND $order['MallOrder']['pay_status'] <= 1){
						//检验订单需要支付金额与实际支付金额是否一致
						$order_amount = $order['MallOrder']['goods_amount'] + $order['MallOrder']['express_fee'];	//订单总金额，显示在支付宝收银台里的“应付总额”里
						
						if($order_amount == $total_fee){	//通过支付金额验证
							/**
							 *	订单付完款后有两种状态
							 *	1：订单中所有商品库存正常，此时操作流程为：
							 *		1.1：更新订单支付状态
							 *		1.2：更新商品库存数量
							 *		1.3：更新商品已经售出数量
							 *	2：订单中出现部分商品库存不足问题，此时操作流程为：
							 *		2.1：更新订单支付状态为“已经付款”
							 *		2.2：更新库存充足商品的库存数量，库存不足商品的库存数量（负数）
							 *		2.3：更新库存不足商品的订单商品(OrderGoods)的库存状态为：1(配货中)
							 *		2.4：更新商品已经售出数量 
							 */
							
							//库存判断,及库存状态变更
							foreach($order['MallOrderGoods'] as $num => $order_goods){
								//获取商品库存信息
								$this->MallGoods->recursive = -1;
								$goods = $this->MallGoods->findById($order_goods['goods_id']); 
								
								//判断库存商品是否缺货，并更新订单商品库存状态：0：正常，1：配货中
								//非缺货情况
								if($goods['MallGoods']['stock'] < $order_goods['goods_number']){
									//更新订单商品库存状态为：配货中-1
									$this->MallOrderGoods->id = $order_goods['id'];
									$this->MallOrderGoods->saveField('stock_status', 1);									
								}

								//更新订单商品库存，此时库存数量为负数
								$this->MallGoods->save(array(
									'MallGoods' => array(
										'id' 		=>	$order_goods['goods_id'],
										'stock'		=>	$goods['MallGoods']['stock'] - $order_goods['goods_number'],
										'sold'		=>	$goods['MallGoods']['sold'] + $order_goods['goods_number'] 
									)
								));								
							}

							//更新支付状态，并设置支付交易编号，及支付时间		
							$data = array();	//订单更新数据					
							$data['MallOrder']['pay_time'] = time();
							$data['MallOrder']['pay_status'] = 2;
							$data['MallOrder']['order_status'] = 1;
							$data['MallOrder']['pay_trade_no'] = $pay_trade_no;

							$data['MallOrder']['id'] = $order['MallOrder']['id'];

							if($this->MallOrder->save($data)){
								$this->flash('恭喜订单支付成功!', '/uc/', 3);
							}
							else{
								//订单状态更新失败
								$this->flash('恭喜订单支付成功! code:2', '/uc/', 3);
							}							
							
							//订单中产品已经无货，支付金额转为账号充值
							
						}
						else{
							$this->flash('支付失败：支付金额校验失败！请联系客服协助处理。', '/Mall/', 3);
						}
					}
					//订单状态为已经付款
		    		elseif ($order['MallOrder']['pay_status'] == 2 ){
						$this->flash('订单已经付款成功!', '/uc/', 3);
					}
					//订单状态为款非付款中状态
					elseif ($order['MallOrder']['order_status'] >= 2 ){
						$this->flash('订单已经取消或无效!', '/uc/', 3);
					}
		    }
		    else {
		    	$this->flash('支付失败：' .$_GET['trade_status']. ' 请联系客服协助处理。', '/Mall/', 3);
		    }
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    //如要调试，请看alipay_notify.php页面的return_verify函数，比对sign和mysign的值是否相等，或者检查$veryfy_result有没有返回true
		    $this->flash('支付通知校验失败， 请联系客服协助处理。', '/Mall/', 3);
		}		
		
		$this->autoRender = false;
	}
	
	public function aliNotify(){
		//加载支付模块
		App::import('Vendor', 'alipay/alipay_notify');
		
		//加载配置信息
		$this->loadModel('Payment');
		$ali = $this->Payment->aliConfig();		

		//构造通知函数信息
		$alipay = new alipay_notify($ali['partner'], $ali['key'], $ali['sign_type'], $ali['_input_charset'], $ali['transport']);
		
		//计算得出通知验证结果
		
		$verify_result = $alipay->notify_verify();
		
		if($verify_result){//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
		    $order_sn           = $_POST['out_trade_no'];    //获取订单号
		    $total_fee          = $_POST['total_fee'];	    //获取总价格,即总支付金额
		    $pay_trade_no		= $_POST['trade_no'];		//支付交易编号
		    
		    if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
					
					//订单状态：0-未确认；1-已确认；2-配货中；3-已发货；4-已取消；5-无效；6-退货；
					//支付状态；0-未付款；1-付款中；2-已付款
					$order = $this->MallOrder->findByOrderSn($order_sn);					
					if($order['MallOrder']['order_status'] <= 1 AND $order['MallOrder']['pay_status'] <= 1){
						//检验订单需要支付金额与实际支付金额是否一致
						$order_amount = $order['MallOrder']['goods_amount'] + $order['MallOrder']['express_fee'];	//订单总金额，显示在支付宝收银台里的“应付总额”里
						
						if($order_amount == $total_fee){	//通过支付金额验证
							/**
							 *	订单付完款后有两种状态
							 *	1：订单中所有商品库存正常，此时操作流程为：
							 *		1.1：更新订单支付状态
							 *		1.2：更新商品库存数量
							 *	2：订单中出现部分商品库存不足问题，此时操作流程为：
							 *		2.1：更新订单支付状态为“已经付款”
							 *		2.2：更新库存充足商品的库存数量，库存不足商品的库存数量（负数）
							 *		2.3：更新库存不足商品的订单商品(OrderGoods)的库存状态为：1(配货中) 
							 */
							
							//库存判断,及库存状态变更
							foreach($order['MallOrderGoods'] as $num => $order_goods){
								//获取商品库存信息
								$this->MallGoods->recursive = -1;
								$goods = $this->MallGoods->findById($order_goods['goods_id']); 
								
								//判断库存商品是否缺货，并更新订单商品库存状态：0：正常，1：配货中
								//非缺货情况
								if($goods['MallGoods']['stock'] < $order_goods['goods_number']){
									//更新订单商品库存状态为：配货中-1
									$this->MallOrderGoods->id = $order_goods['id'];
									$this->MallOrderGoods->saveField('stock_status', 1);									
								}

								//更新订单商品库存，此时库存数量为负数
								$this->MallGoods->save(array(
									'MallGoods' => array(
										'id' 		=>	$order_goods['goods_id'],
										'stock'		=>	$goods['MallGoods']['stock'] - $order_goods['goods_number'],
										'sold'		=>	$goods['MallGoods']['sold'] + $order_goods['goods_number'] 
									)
								));								
							}

							//更新支付状态，并设置支付交易编号，及支付时间		
							$data = array();	//订单更新数据					
							$data['MallOrder']['pay_time'] = time();
							$data['MallOrder']['pay_status'] = 2;
							$data['MallOrder']['order_status'] = 1;
							$data['MallOrder']['pay_trade_no'] = $pay_trade_no;

							$data['MallOrder']['id'] = $order['MallOrder']['id'];

							if($this->MallOrder->save($data)){
								echo 'success';
							}
							else{
								//订单状态更新失败
								echo 'fail';
							}							
						}
						else{	//支付金额校验失败
							echo 'fail';
						}
					}
					//订单状态为已经付款
		    		elseif ($order['MallOrder']['pay_status'] == 2 ){
						echo 'success';
					}
					//订单状态为款非付款中状态
					elseif ($order['MallOrder']['order_status'] >= 2 ){
						echo 'fail';
					}
		    }
		    else {
		    	echo "success";		//其他状态判断。普通即时到帐中，其他状态不用判断，直接打印success。
		    }
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    echo 'fail';
		}
		$this->autoRender = false;
	}
	
	/**
	 * 财会通支付响应
	 */
	public function tenPayResponse(){	    
		//加载支付模块
		App::import('Vendor', 'tenpay/pay_response_handler');
		
		//加载配置信息
		$this->loadModel('Payment');
		$tenConfig = $this->Payment->tenConfig();

		/* 创建支付应答对象 */
		$tenPay = new PayResponseHandler();
		$tenPay->setKey($tenConfig['key']);		
				
		//针对CakePHP路径问题处理$_GET['url']项，暂时只做此处理，可能还有其他额外KEY需要处理
		if(isset($_GET['url'])){
			unset($_GET['url']);
		}
			
		$verify_result = $tenPay->isTenpaySign();
		
		if($verify_result){//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			
			$transaction_id = $tenPay->getParameter("transaction_id");			//交易单号			
			$total_fee = $tenPay->getParameter("total_fee");		//金额,以分为单位			
			$pay_result = $tenPay->getParameter("pay_result");		//支付结果
			$order_sn = $tenPay->getParameter('sp_billno');			//订单号
		    
		    if($pay_result == "0") {
				//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
					
					//订单状态：0-未确认；1-已确认；2-已取消；3-无效；4-退货；
					//支付状态；0-未付款；1-付款中；2-已付款
					$order = $this->MallOrder->findByOrderSn($order_sn);					
					if($order['MallOrder']['order_status'] <= 1 AND $order['MallOrder']['pay_status'] <= 1){
						//检验订单需要支付金额与实际支付金额是否一致
						$order_amount = ($order['MallOrder']['goods_amount'] + $order['MallOrder']['express_fee']) * 100;	//订单总金额，显示在支付宝收银台里的“应付总额”里
						
						if($order_amount == $total_fee){	//通过支付金额验证
							/**
							 *	订单付完款后有两种状态
							 *	1：订单中所有商品库存正常，此时操作流程为：
							 *		1.1：更新订单支付状态
							 *		1.2：更新商品库存数量
							 *		1.3：更新商品已经售出数量
							 *	2：订单中出现部分商品库存不足问题，此时操作流程为：
							 *		2.1：更新订单支付状态为“已经付款”
							 *		2.2：更新库存充足商品的库存数量，库存不足商品的库存数量（负数）
							 *		2.3：更新库存不足商品的订单商品(OrderGoods)的库存状态为：1(配货中)
							 *		2.4：更新商品已经售出数量 
							 */
							
							//库存判断,及库存状态变更
							foreach($order['MallOrderGoods'] as $num => $order_goods){
								//获取商品库存信息
								$this->MallGoods->recursive = -1;
								$goods = $this->MallGoods->findById($order_goods['goods_id']); 
								
								//判断库存商品是否缺货，并更新订单商品库存状态：0：正常，1：配货中
								//非缺货情况
								if($goods['MallGoods']['stock'] < $order_goods['goods_number']){
									//更新订单商品库存状态为：配货中-1
									$this->MallOrderGoods->id = $order_goods['id'];
									$this->MallOrderGoods->saveField('stock_status', 1);									
								}

								//更新订单商品库存，此时库存数量为负数
								$this->MallGoods->save(array(
									'MallGoods' => array(
										'id' 		=>	$order_goods['goods_id'],
										'stock'		=>	$goods['MallGoods']['stock'] - $order_goods['goods_number'],
										'sold'		=>	$goods['MallGoods']['sold'] + $order_goods['goods_number'] 
									)
								));								
							}

							//更新支付状态，并设置支付交易编号，及支付时间		
							$data = array();	//订单更新数据					
							$data['MallOrder']['pay_time'] = time();
							$data['MallOrder']['pay_status'] = 2;
							$data['MallOrder']['order_status'] = 1;
							$data['MallOrder']['pay_trade_no'] = $transaction_id;

							$data['MallOrder']['id'] = $order['MallOrder']['id'];

							if($this->MallOrder->save($data)){
								//调用doShow, 打印meta值跟js代码,告诉财付通处理成功,并在用户浏览器显示$show页面.
								$tenPay->doShow($tenConfig['show_url']);
							}
							else{
								//订单状态更新失败
								$this->flash('恭喜订单支付成功! code:2', '/uc/', 3);
							}							
							
							//订单中产品已经无货，支付金额转为账号充值
							
						}
						else{
							$this->flash('支付失败：支付金额校验失败！请联系客服协助处理。', '/Mall/', 3);
						}
					}
					//订单状态为已经付款
		    		elseif ($order['MallOrder']['pay_status'] == 2 ){
						$this->flash('订单已经付款成功!', '/uc/', 3);
					}
					//订单状态为款非付款中状态
					elseif ($order['MallOrder']['order_status'] >= 2 ){
						$this->flash('订单已经取消或无效!', '/uc/', 3);
					}
		    }
		    else {
		    	$this->flash('支付失败， 请联系客服协助处理。', '/Mall/', 3);
		    }
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    $this->flash('财付通支付通知校验失败， 请联系客服协助处理。', '/Mall/', 3);
		}		
		
		$this->autoRender = false;
	}				
	
	/**
	 * 支付成功显示操作提示
	 */
	public function tenPaySuccess(){
		$this->flash('恭喜您，支付成功！', '/uc/', 3);
	}
}