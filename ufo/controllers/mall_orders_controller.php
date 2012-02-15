<?php
class MallOrdersController extends AppController{
	var $uses = array('MallOrder', 'MallConsignee', 'MallExpress', 'Payment');
	var $paginate = array(
		'limit' => 20,
		'order' => array(
			'MallOrder.id' => 'DESC'
		)
	);
	
	
	public function index(){
		$list = $this->paginate('MallOrder');
		
		//处理订单信息代码
		foreach($list as $num => $order){
			$list[$num]['MallOrder']['order_status'] = $this->MallOrder->getStatus('order_status', $order['MallOrder']['order_status']);
			$list[$num]['MallOrder']['pay_status'] = $this->MallOrder->getStatus('pay_status', $order['MallOrder']['pay_status']);
		}		
		$this->set('list', $list);
	}
	
	public function view($id){
		$this->MallOrder->id = $id;
		$order = $this->MallOrder->read();
		
		//将地区代码转换成对应名称
		$order['MallOrder']['province'] = $this->MallConsignee->getRegionName($order['MallOrder']['province']);
		$order['MallOrder']['city'] = $this->MallConsignee->getRegionName($order['MallOrder']['city']);
		$order['MallOrder']['district'] = $this->MallConsignee->getRegionName($order['MallOrder']['district']);
				
		//订单状态代码转换
		$order['MallOrder']['pay_status'] = $this->MallOrder->getStatus('pay_status', $order['MallOrder']['pay_status']);
		$order['MallOrder']['order_status'] = $this->MallOrder->getStatus('order_status', $order['MallOrder']['order_status']);
		
		//支付方式代码转换
		$order['MallOrder']['pay_name'] = $this->Payment->getPayName($order['MallOrder']['pay_id']);
		
		//配送方式代码转换
		$order['MallOrder']['express_name'] = $this->MallExpress->getExpressName($order['MallOrder']['express_id']);
				
		$this->set('order', $order);
	}
	
	public function delivery($order_id){		
		if($this->data){
			//订单状态设置为已经发货
			$this->data['MallOrder']['order_status'] = 3;
			$this->data['MallOrder']['delivery_time'] = time();
			if($this->MallOrder->save($this->data)){
				$this->flash('成功发货', '/MallOrders/view/' . $order_id, 3);
			}
			else{
				$this->flash('发货失败', '/MallOrders/view/' . $order_id, 3);
			}
		}	
		else{
			$this->MallOrder->id = $order_id;
			$this->MallOrder->recursive = -1;
			$this->data = $this->MallOrder->read();			
		}
	}
}