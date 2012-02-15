<?php
class MallGoodsType extends AppModel{
	var $name = 'MallGoodsType';
	var $useTable = 'mall_goods_types';

	var $hasOne = array(
		'MallGoodsDesc' => array(
			'className' 	 => 'MallGoodsDesc',
			'foreignKey'	 => 'goods_id',
			'dependent' 	 => true 
		)	
	);
		
	var $hasMany = array(
		'MallGoods' => array(
			'className' => 'MallGoods',
			'foreignKey' => 'goods_type_id',
			'counterCatche' => true
		)
	);
}