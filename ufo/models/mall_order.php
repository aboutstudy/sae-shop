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
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'user_id'
		)
	);
	
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
						$status = '<span style="color:green;">已经确认</span>';
						break;
					case 2:
						$status = '<span style="color:red;">配货中</span>';
						break;			
					case 3:
						$status = '已发货';
						break;			
					case 4:
						$status = '已取消';
						break;			
					case 5:
						$status = '无效';
						break;			
					case 6:
						$status = '已退货';
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
						$status = '<span style="color:red; font-weight:bold;">已付款</span>';
						break;									
				}
				break;				
		}
		return $status;
	}
}