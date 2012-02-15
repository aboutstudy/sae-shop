<?php
class MallBrand extends AppModel{
	var $name = 'MallBrand';
	var $useTable = 'mall_brands';
		
	var $hasMany = array(
		'MallGoods' => array(
			'className' => 'MallGoods',
			'foreignKey' => 'brand_id',
			'counterCatche' => true
		)
	);
}