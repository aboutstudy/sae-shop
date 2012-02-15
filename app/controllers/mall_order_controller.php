<?php
class MallOrderController extends AppController{
	var $name = 'MallOrder';
	var $uses = array('MallOrder', 'MallGoods', 'MallOrderGoods', 'MallConsignee', 'MallCart', 'Payment', 'MallExpress');
	var $paginate = array(
		'limit' => 10,
		'order' => array('MallOrder.id' => 'DESC')
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$user = $this->Auth->user();		
		if(empty($user['User']['username'])){
			$this->flash('在豆壳安家得有个超有范的昵称吧~', '/users/setting');
		}
		$this->set('title_for_layout', '我的豆壳');
		$this->layout = 'uc';
	}	
	
	public function beforeRender(){
//		计算购物车中商品数量 		
//		$cart_count = $this->MallCart->find('count', array('conditions' => array('MallCart.session_id' => session_id())));
//		$this->set('cart_count', $cart_count);		
	}
		
	public function index(){
		$user_id = $this->Auth->user('id');
		$order_list = $this->paginate('MallOrder', array('MallOrder.user_id' => $user_id));
		//处理订单信息代码
		foreach($order_list as $num => $order){
			$order_list[$num]['MallOrder']['order_status_name'] = $this->MallOrder->getStatus('order_status', $order['MallOrder']['order_status']);
			$order_list[$num]['MallOrder']['pay_status_name'] = $this->MallOrder->getStatus('pay_status', $order['MallOrder']['pay_status']);
		}		
		
		$this->set('order', $order_list);
		
		$this->set('title_for_layout', '订单管理');
	}
	
	public function view($id){
		$user_id = $this->Auth->user('id');		
		$order = $this->MallOrder->find('first', array('conditions' => array('MallOrder.id' => $id, 'MallOrder.user_id' => $user_id)));
		
		if($order){
			//将地区代码转换成对应名称
			$order['MallOrder']['province'] = $this->MallConsignee->getRegionName($order['MallOrder']['province']);
			$order['MallOrder']['city'] = $this->MallConsignee->getRegionName($order['MallOrder']['city']);
			$order['MallOrder']['district'] = $this->MallConsignee->getRegionName($order['MallOrder']['district']);
			
			//订单状态代码转换
			$order['MallOrder']['pay_status_name'] = $this->MallOrder->getStatus('pay_status', $order['MallOrder']['pay_status']);
			$order['MallOrder']['order_status_name'] = $this->MallOrder->getStatus('order_status', $order['MallOrder']['order_status']);		
			
			//支付方式代码转换
			$order['MallOrder']['pay_name'] = $this->Payment->getPayName($order['MallOrder']['pay_id']);
			
			//配送方式代码转换
			$order['MallOrder']['express_name'] = $this->MallExpress->getExpressName($order['MallOrder']['express_id']);
			$this->set('order', $order);		
			$this->set('title_for_layout', '订单详情');			
		}
		else{
			$this->flash('查无此订单,若有疑问请联系客服！', '/MallOrder/index/', 3);
		}
	}
}
