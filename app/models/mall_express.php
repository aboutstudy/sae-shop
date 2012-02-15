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
	 * 获取当前购物车中所有产品列表
	 */
	public function getList(){
		$express = $this->find('list', array('conditions' => array('MallExpress.status' => 1), 'fields' => 'MallExpress.title'));
		return $express;	
	}
	
	/**
	 * 运费计算 
	 * @param $express_id		配送方式
	 * @param $goods_amount		订单总价
	 * @param $goods_num		订单产品数量
	 */
	public function getFee($express_id, $goods_amount, $goods_num = 1){
		$fee = 0;		
			
		$data = $this->findById($express_id);
		$fee = $data['MallExpress']['fee'];
		
		//按运费免运费
		if($goods_amount >= 20000){
			$fee = $fee - $data['MallExpress']['discount'];
		}
		
		//按产品数量计算 
		if($goods_num >= 200000){
			$fee = $fee - $data['MallExpress']['discount'];				
		}
		
		if($fee < 0) $fee = 0;
		
		return $fee;	
	}	
	
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