<?php
class MallGoodsCategorys extends AppModel{
	var $name = 'MallGoodsCategorys';
	var $useTable = 'mall_goods_categorys';
	
	var $belongsTo = array(		
		'MallGoods' => array(
			'className' => 'MallGoods',
			'foreignKey' => 'goods_id',
			'order' => array('MallGoods.id' => 'DESC')			
		),
		'MallCategory' => array(
			'className' => 'MallCategory',
			'foreignKey' => 'category_id'
		) 
	);
}