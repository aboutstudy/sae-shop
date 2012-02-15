<?php
class MallSection extends AppModel{
	var $name = 'MallSection';
	var $hasAndBelongsToMany = array(
		'MallGoods' => array(
			'className'		 => 'MallGoods',
			'joinTable'		 => 'mall_goods_sections',
			'foreignKey'	 => 'section_id',
			'associationForeignKey'	=> 'goods_id',
			'order' => array(
				'MallGoods.sort_order' => 'DESC',
				'MallGoods.id' => 'DESC'				
			),	
			'limit'	=> 20,
		)
	);
}