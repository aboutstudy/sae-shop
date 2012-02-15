<?php
class MallGoodsComment extends AppModel{
	var $name = 'MallGoodsComment';
	
	var $belongsTo = array(
		'MallGoods' => array(
			'className' => 'MallGoods',
			'foreignKey' => 'goods_id',
			'counterCache' => true		
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
		)
	); 
}