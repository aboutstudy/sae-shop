<?php
class MallCatType extends AppModel{
	var $name = 'MallCatType';
	var $useTable = 'mall_cat_types';
	
	var $hasMany = array(
		'MallCategory' => array(
			'className' => 'MallCategory',
			'foreignKey' => 'type_id'
		)
	);
}