<?php
class MallCategory extends AppModel{
	var $name = 'MallCategory';
	var $useTable = 'mall_categorys';
	
	var $hasAndBelongsToMany = array(
		'MallGoods' => array(
			'className'		 => 'MallGoods',
			'joinTable'		 => 'mall_goods_categorys',
			'foreignKey'	 => 'category_id',
			'associationForeignKey'	=> 'goods_id'
		)
	);
	
	var $belongsTo = array(
		'MallCatType' => array(
			'className' => 'MallCatType',
			'foreignKey' => 'type_id',
			'counterCache' => true
		)
	);
}