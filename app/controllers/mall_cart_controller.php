<?php
class MallCartController extends AppController{
	var $uses = array('MallGoods', 'MallCart', 'MallOrder', 'MallOrderGoods', 'MallGoods', 'MallRegion', 'MallExpress', 'MallConsignee', 'Help');
		
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow("index", "add", "delete", "updateGoodsCount", "ajaxGetCartNum");		
		$this->layout = 'mall';	
	}
	
	public function beforeRender(){
//		计算购物车中商品数量 		
//		$cart_count = $this->MallCart->find('count', array('conditions' => array('MallCart.session_id' => session_id())));
//		$this->set('cart_count', $cart_count);		
	}	
	
	public function index(){						
		$cartList = $this->MallCart->find('all', array('conditions' => array('MallCart.session_id' => session_id())));
		$this->set('cartList', $cartList);
		
		//获取购物车中商品总价
		$totalGoodsPrice = $this->MallCart->totalGoodsPrice();
		$this->set('totalGoodsPrice', $totalGoodsPrice);
					
		//获取帮助文档
		$helpList = $this->Help->getOthers(4);
		$this->set('helpList', $helpList);		
				
		$this->set('title_for_layout', '购物车');	
	}
	
	public function add($goods_id, $goods_number){
		//判断是否已经添加过
		if($this->MallCart->find('count', array('conditions' => array('goods_id' => $goods_id, 'session_id' => session_id())))){
						
		}
		else{
			$this->MallGoods->id = $goods_id;
			$this->MallGoods->recursive = -1;
			$data = $this->MallGoods->read();
			
			$data['MallCart'] = array(
				'session_id' => session_id(),
				'goods_id' => $goods_id,
				'goods_sn' => $data['MallGoods']['sn'],
				'goods_name' => $data['MallGoods']['short_title'],
				'goods_thumb' => $data['MallGoods']['thumb_small'],
				'market_price' => $data['MallGoods']['market_price'],
				//商品价格计算逻辑，暂不做促销等价格处理，直接为原售价
				'goods_price' => $data['MallGoods']['shop_price'],			
				'goods_num'  => $goods_number
			);
			
			if($this->MallCart->save($data['MallCart'])){
				/*
				$response = array(
					'cart_id' => $this->MallCart->id,
					'msg' => '成功加入购物车'
				);
				*/			
			}			
		}
		
		//获取购物车中商品记录
		$cartList = $this->MallCart->find('all', array('conditions' => array('MallCart.session_id' => session_id())));
		$this->set('cartList', $cartList);
		
		//获取购物车中商品总价
		$totalGoodsPrice = $this->MallCart->totalGoodsPrice();
		$this->set('totalGoodsPrice', $totalGoodsPrice);
					
		//获取帮助文档
		$helpList = $this->Help->getOthers(4);
		$this->set('helpList', $helpList);		
		
		$this->set('title_for_layout', '添加成功！ - 购物车');
		$this->render('/mall_cart/index');				
		
		/*
		 * Ajax提交
		$response = array(
			'error' => '错误提示',
			'error_code' => '1001'
		);
		echo json_encode($response);
		*/
				
//		$this->autoRender = false;		
	}
	
	/**
	 * 订单确认
	 */
	public function checkOrder(){
		$user_id = $this->Auth->user('id');
		
		//订单清单
		$cartList = $this->MallCart->find('all', array('conditions' => array('MallCart.session_id' => session_id())));
		$this->set('cartList', $cartList);

		//获取配送区域
		$regions = $this->MallRegion->find('list', array('conditions' => array('MallRegion.parent_id' => 1), 'fields' => 'MallRegion.region_name'));
		$this->set('regions', $regions);
		
		//获取历史收货地址
		$consigneeList = $this->MallConsignee->getList($user_id);
		$this->set('consigneeList', $consigneeList);
		
		//获取配送方式
		$express = $this->MallExpress->getList();
		$this->set('express', $express);
				
		//订单产品统计
		$cartGoods = $this->MallCart->find('all', array('conditions' => array('MallCart.session_id' => session_id())));
		
		if(empty($cartGoods)){
			$this->flash('Sorry, 购物车已经清空！', '/Mall/', 3);
		}
		else{
			$data = array();
			//订单总价统计
			$data['MallOrder']['goods_amount'] = 0;	
			$cart_goods_num = 0;
			foreach ($cartGoods as $cart_item){
				$data['MallOrderGoods'][] = array(
					'goods_id' 		=> $cart_item['MallGoods']['id'],
					'goods_name' 	=> $cart_item['MallGoods']['short_title'],
					'goods_sn'		=> $cart_item['MallGoods']['sn'],
					'goods_number'	=> $cart_item['MallCart']['goods_num'],
					'market_price'  => $cart_item['MallGoods']['market_price'],
					'goods_price' 	=> $cart_item['MallCart']['goods_price'],
					'goods_attr' 	=> $cart_item['MallCart']['goods_attr'],	 
				);
				$data['MallOrder']['goods_amount'] = $data['MallOrder']['goods_amount'] + $cart_item['MallCart']['goods_price'] * $cart_item['MallCart']['goods_num'];
				$cart_goods_num = $cart_goods_num + $cart_item['MallCart']['goods_num'];
			}		
			//商品总价
			$this->set('goods_amount', $data['MallOrder']['goods_amount']);		
			
			//订单默认配送方式下的配送费用
			$express_fee = $this->MallExpress->getFee(current(array_keys($express)), $data['MallOrder']['goods_amount'], $cart_goods_num);
			$this->set('express_fee', $express_fee);
			
			//订单中商品总数
			$this->set('cart_goods_num', $cart_goods_num);
			
			//获取帮助文档
			$helpList = $this->Help->getOthers(4);
			$this->set('helpList', $helpList);
			
			$this->set('title_for_layout', '订单确认');			
		}
	}
	
	/**
	 * 删除购物车中记录
	 * @param unknown_type $mall_cart_id 购物车记录ID
	 */
	public function delete($mall_cart_id){
		if($this->MallCart->delete($mall_cart_id)){
			
		}
		
		$cartList = $this->MallCart->find('all', array('conditions' => array('MallCart.session_id' => session_id())));
		$this->set('cartList', $cartList);

		//获取购物车中商品总价
		$totalGoodsPrice = $this->MallCart->totalGoodsPrice();
		$this->set('totalGoodsPrice', $totalGoodsPrice);
				
		$this->render('/mall_cart/index');
	}
	
	/**
	 * 更新购物车中单品订购数量
	 * @param unknown_type $cart_id
	 * @param unknown_type $num
	 */
	public function updateGoodsCount($cart_id, $num){
		$response = array();
		
		$this->MallCart->id = $cart_id;
		if($this->MallCart->saveField('goods_num', $num)){
			$response = array(
				'success' => '更新成功'
			);	
		}
		else{
			$response = array(
				'error' => '更新失败'
			);
		}
		echo json_encode($response);
		$this->autoRender = false;
	}
	
	/**
	 * 获取下级区域
	 * @param unknown_type $region_type
	 * @param unknown_type $parent_id
	 */
	public function getRegions($region_type, $parent_id){
		$list = $this->MallRegion->find('list', array('conditions' => array('MallRegion.parent_id' => $parent_id), 'fields' => array('MallRegion.region_name')));
		
		switch ($region_type){
			case '1':
				$options = '<span><select id="MallOrderCity" region_type="2" name="data[MallOrder][city]" onchange="javascript:jQuery.getRegions(this)">
							<option value="">城市</option>';							
				break;
			case '2':
				$options = '<span><select id="MallOrderDistrict" region_type="3" name="data[MallOrder][district]">
							<option value="">街区</option>';							
				break;					
		}
		
		foreach($list as $region_id => $region_name){
			$options .= '<option value="'.$region_id.'">'.$region_name.'</option>';			
		}		
		$options .= '</select></span>';
		echo $options;
		$this->autoRender = false;
	}
	
	/**
	 * 生成订单，并生成支付按钮
	 */
	public function orderPay(){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo "感谢您的访问，本站当前暂停服务。";exit;
		//订单产品统计
		$cartGoods = $this->MallCart->find('all', array('conditions' => array('MallCart.session_id' => session_id())));
		if(empty($cartGoods)){
			$this->redirect('/MallOrder/index');
		}	
		else{
			//生成订单、订单号，保存订单ID
			$user_id = $this->Auth->user('id');
			$data = array();
			$data['MallOrder']['order_sn'] = $this->MallOrder->getOrderSN();
			$data['MallOrder']['user_id'] = $user_id;		
			$data['MallOrder']['order_status'] = 0;		//-1:纠纷售后处理中  0:订单生成 未付款  1:订单部分付款	2:完成付款 3:已发货 4:已收货
			$data['MallOrder']['pay_status'] = 0;
			
			$data['MallOrder']['goods_amount'] = 0;
					
			//订单含产品个数
			$cart_goods_num = 0;	
			foreach ($cartGoods as $cart_item){
				//库存处理与判断
				/*
				$goods = $this->MallGoods->getGoods($cart_item['MallGoods']['id']);
				if($cart_item['MallCart']['goods_num'] > $goods['MallGoods']['stock']){
					//库存不够
				}			
				*/
				$data['MallOrderGoods'][] = array(
					'goods_id' 		=> $cart_item['MallGoods']['id'],
					'goods_name' 	=> $cart_item['MallGoods']['short_title'],
					'goods_thumb'	=> $cart_item['MallGoods']['thumb_small'],
					'goods_sn'		=> $cart_item['MallGoods']['sn'],
					'goods_number'		=> $cart_item['MallCart']['goods_num'],
					'market_price'  => $cart_item['MallGoods']['market_price'],
					'goods_price' 	=> $cart_item['MallCart']['goods_price'],
					'goods_attr' 	=> $cart_item['MallCart']['goods_attr'],	 
				);
				$data['MallOrder']['goods_amount'] = $data['MallOrder']['goods_amount'] + $cart_item['MallCart']['goods_price'] * $cart_item['MallCart']['goods_num'];
				
				//计算订单含 产品个数
				$cart_goods_num = $cart_goods_num + $cart_item['MallCart']['goods_num'];
			}
			
			//配送方式
			$data['MallOrder']['express_id'] = $this->data['MallOrder']['express_id'];
			
			//运费计算 
			$data['MallOrder']['express_fee'] = $this->MallExpress->getFee($this->data['MallOrder']['express_id'], $data['MallOrder']['goods_amount'], $cart_goods_num);
			
			//收货地址
			if($this->data['consignee_id'] == 0){
	        	$data['MallOrder']['consignee'] = $this->data['MallOrder']['consignee'];
	            $data['MallOrder']['province'] = $this->data['MallOrder']['province'];
	            $data['MallOrder']['city'] = $this->data['MallOrder']['city']; 
	            $data['MallOrder']['district'] = $this->data['MallOrder']['district'];
	            $data['MallOrder']['address'] = $this->data['MallOrder']['address']; 
	            $data['MallOrder']['zipcode'] = $this->data['MallOrder']['zipcode']; 
	            $data['MallOrder']['mobile'] = $this->data['MallOrder']['mobile']; 
	            $data['MallOrder']['tell'] = $this->data['MallOrder']['tell'];
	
	            //插入新收货地址记录
	            $data['Consignee']['user_id'] = $user_id;
	        	$data['Consignee']['consignee'] = $this->data['MallOrder']['consignee'];
	            $data['Consignee']['province'] = $this->data['MallOrder']['province'];
	            $data['Consignee']['city'] = $this->data['MallOrder']['city']; 
	            $data['Consignee']['district'] = $this->data['MallOrder']['district'];
	            $data['Consignee']['address'] = $this->data['MallOrder']['address']; 
	            $data['Consignee']['zipcode'] = $this->data['MallOrder']['zipcode']; 
	            $data['Consignee']['mobile'] = $this->data['MallOrder']['mobile']; 
	            $data['Consignee']['tell'] = $this->data['MallOrder']['tell'];
	            $this->MallConsignee->save($data['Consignee']);
			}
			else{
				//获取选择的上一次收货地址信息
				$consignee = $this->MallConsignee->getHistory($this->data['consignee_id']);
	        	$data['MallOrder']['consignee'] = $consignee['MallConsignee']['consignee'];
	            $data['MallOrder']['province'] = $consignee['MallConsignee']['province'];
	            $data['MallOrder']['city'] = $consignee['MallConsignee']['city']; 
	            $data['MallOrder']['district'] = $consignee['MallConsignee']['district'];
	            $data['MallOrder']['address'] = $consignee['MallConsignee']['address']; 
	            $data['MallOrder']['zipcode'] = $consignee['MallConsignee']['zipcode']; 
	            $data['MallOrder']['mobile'] = $consignee['MallConsignee']['mobile']; 
	            $data['MallOrder']['tell'] = $consignee['MallConsignee']['tell'];			
			}
			
			//支付方式
			$data['MallOrder']['pay_id'] = $this->data['MallOrder']['pay_id'];
			
			//订单留言
			$data['MallOrder']['order_remark'] = substr(strip_tags($this->data['MallOrder']['order_remark']), 0, 250);
			
			//生成订单
			
			$this->MallOrder->save($data['MallOrder']);
			if($this->MallOrder->id === false){
				$this->flash('订单保存失败！', '/MallCart/checkOrder', 3);
			}
			
			//保存订单商品
			foreach($data['MallOrderGoods'] as $num => $order_goods){
				$data['MallOrderGoods'][$num]['order_id'] = $this->MallOrder->id;
			}
			$this->MallOrderGoods->saveAll($data['MallOrderGoods']);
			
			//清空购物车
			$this->MallCart->flush();

			//加载支付功能模型
			$this->loadModel('Payment');
			
			if($data['MallOrder']['pay_id'] == 1){		
				$paymentCode = $this->Payment->payCode($data, 1);
				$this->set('payment_name', '支付宝');		
			}
			elseif($data['MallOrder']['pay_id'] == 2){				
				$paymentCode = $this->Payment->payCode($data, 2);	
				$this->set('payment_name', '财付通');			
			}
			
			$this->set('paymentCode', $paymentCode);
			
			//订单简述
			$this->set('order_sn', $data['MallOrder']['order_sn']);
			$this->set('goods_amount', $data['MallOrder']['goods_amount']);
			$this->set('express_fee', $data['MallOrder']['express_fee']);
			
			$this->set('title_for_layout', '订单支付');
			
			//获取帮助文档
			$helpList = $this->Help->getOthers(4);
			$this->set('helpList', $helpList);			
		}	
	}
	
	/**
	 * 计算订单运费
	 * @param unknown_type $express_id
	 * @param unknown_type $goods_amount
	 * @param unknown_type $cart_goods_num
	 */
	public function getExpressFee($express_id, $goods_amount, $cart_goods_num){
		//运费计算 
		$express_fee = $this->MallExpress->getFee($express_id, $goods_amount, $cart_goods_num);
		echo "￥" . $express_fee;
		
		$this->autoRender = false;
	}
	
	public function ajaxGetCartNum(){
		$cart_count = $this->MallCart->find('count', array('conditions' => array('MallCart.session_id' => session_id())));
		echo $cart_count;
		$this->autoRender = false;	
	}
	
	/**
	 * 会员中心订单支付
	 * @param unknown_type $order_id
	 */
	public function ucOrderPay($order_id){
		//获取订单信息
		$user_id = $this->Auth->user('id');
		$this->MallOrder->recursive = -1;
		$data = $this->MallOrder->find('first', array('conditions' => array('MallOrder.id' => $order_id, 'MallOrder.user_id' => $user_id)));
		
		if(empty($data)){
			$this->flash('查无此订单，若有疑问请联系客服！', '/MallOrder/index', 3);
		}	
		else{
			//加载配置信息
			$this->loadModel('Payment');			
								
			if($data['MallOrder']['pay_id'] == 1){
				$paymentCode = $this->Payment->payCode($data, 1);
				$this->set('payment_name', '支付宝');			
			}
			else{				
				$paymentCode = $this->Payment->payCode($data, 2);
				$this->set('payment_name', '财付通');				
			}
			
			$this->set('paymentCode', $paymentCode);			
			
			//订单简述
			$this->set('order_sn', $data['MallOrder']['order_sn']);
			$this->set('goods_amount', $data['MallOrder']['goods_amount']);
			$this->set('express_fee', $data['MallOrder']['express_fee']);
			$this->set('title_for_layout', '订单支付');		
			
			//获取帮助文档
			$helpList = $this->Help->getOthers(4);
			$this->set('helpList', $helpList);				
		}	
	}
		
}