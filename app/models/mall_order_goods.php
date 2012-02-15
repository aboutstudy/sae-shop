<?php
class MallOrderGoods extends AppModel{
	var $name = 'MallOrderGoods';
	var $useTable = 'mall_order_goods';
	
	var $belongsTo = array(
		'MallOrder' => array(
			'className' => 'MallOrder',
			'foreignKey' => 'order_id'
		)
	);
}