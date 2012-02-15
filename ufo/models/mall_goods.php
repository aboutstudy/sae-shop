<?php
class MallGoods extends AppModel{
	var $name = 'MallGoods';
	var $useTable = 'mall_goods';

	var $hasOne = array(
		'MallGoodsDesc' => array(
			'className' => 'MallGoodsDesc',
			'foreignKey' => 'goods_id'
		),
		'MallGoodsWeibo' => array(
			'className' => 'MallGoodsWeibo',
			'foreignKey' =>'goods_id'
		)
	);
	var $hasAndBelongsToMany = array(
		'Tag' => array(
			'className'		 => 'Tag',
			'joinTable'		 => 'mall_goods_tags',
			'foreignKey'	 => 'goods_id',
			'associationForeignKey'	=> 'tag_id'
		),
		'MallCategory' => array(
			'className'		 => 'MallCategory',
			'joinTable' 	 => 'mall_goods_categorys',
			'foreignKey' 	 => 'goods_id',
			'associationForeignKey'	=> 'category_id'
		),
		'MallSection' => array(
			'className'		 => 'MallSection',
			'joinTable' 	 => 'mall_goods_sections',
			'foreignKey' 	 => 'goods_id',
			'associationForeignKey'	=> 'section_id'
		) 
	);	
	var $belongsTo = array(
		'User'	 => array(
			'className' 	 => 'User',
			'foreignKey' 	 => 'user_id'
		),
		'Member' => array(
			'className' 	 => 'Member',
			'foreignKey' 	 => 'member_id'
		),
		'MallGoodsType' => array(
			'className' => 'MallGoodsType',
			'foreignKey' => 'goods_type_id'
		),
		'MallBrand' => array(
			'className' => 'MallBrand',
			'foreignKey' => 'brand_id'
		)
	);
}