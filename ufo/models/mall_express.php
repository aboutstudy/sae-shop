<?php
class MallExpress extends AppModel{
	var $name = 'MallExpress';
	var $useTable = 'mall_express';
	
	var $hasMany = array(
		'MallOrder' => array(
			'className' => 'MallOrder',
			'foreignKey' => 'express_id'
		)
	);
	
	/**
	 * 根据配送方式ID，返回配送方式名称
	 * @param unknown_type $express_id
	 * @return unknown
	 */
	public function getExpressName($express_id){
		$this->id = $express_id;
		$express_name = $this->field('title');
		return $express_name; 
	}	
}