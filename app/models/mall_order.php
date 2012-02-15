<?php
class MallOrder extends AppModel {
	var $name = 'MallOrder';
	var $useTable = 'mall_orders';
	
	var $hasMany = array(
		'MallOrderGoods' => array(
			'className' => 'MallOrderGoods',
			'foreignKey' => 'order_id'
		)
	);
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);
	
	/**
	 * 获取订单序列号
	 */
	public function getOrderSN(){
	    /* 选择一个随机的方案 */
	    mt_srand((double) microtime() * 1000000);	
	    $sn = '';
	    do {
	    	$sn = date('YmdHis') . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
	    } while($this->find('count', array('conditions' => array('MallOrder.order_sn' => $sn))));
	    
	    return $sn;
	}
	/**
	 *	//订单状态：0-未确认；1-已确认；2-配货中；3-已发货；4-已取消；5-无效；6-退货；
	 *	//支付状态；0-未付款；1-付款中；2-已付款
	 *	根据给定字段及字段值返回对应状态
	 * @param unknown_type $field
	 * @param unknown_type $value
	 */
	public function getStatus($field, $value){
		$stauts = '';
		switch($field){
			case 'order_status':
				switch($value){
					case 0:
						$status = '未确认';
						break;	
					case 1:
						$status = '已经确认';
						break;
					case 2:
						$status = '配货中';
						break;			
					case 3:
						$status = '<span class="red bold">已发货</span>';
						break;			
					case 4:
						$status = '<span style="color:gray;">已取消</span>';
						break;			
					case 5:
						$status = '<span style="color:gray;">无效</span>';
						break;			
					case 6:
						$status = '<span style="color:gray;">已退货</span>';
						break;																								
				}
				break;
			case 'pay_status':
				switch($value){
					case 0:
						$status = '未付款';
						break;	
					case 1:
						$status = '付款中';
						break;			
					case 2:
						$status = '<span class="red bold">已付款</span>';
						break;									
				}
				break;				
		}
		return $status;
	}	
}