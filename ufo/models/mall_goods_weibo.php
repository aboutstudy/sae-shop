<?php
class MallGoodsWeibo extends AppModel{
	var $name = 'MallGoodsWeibo';
		
	var $belongsTo = array(
		'MallGoods' => array(
			'className' => 'MallGoods',
			'foreignKey' => 'goods_id'
		)
	);
}