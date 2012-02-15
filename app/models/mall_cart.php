<?php
class MallCart extends AppModel{
	var $name = 'MallCart';
	var $useTable = 'mall_carts';
	
	var $belongsTo = array(
		'MallGoods' => array(
			'className' => 'MallGoods',
			'foreignKey' => 'goods_id'
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'user_id'
		)
	);
	
	/**
	 * 获取当前购物中订单商品总价
	 */
	public function totalGoodsPrice(){
		$cartList = $this->find('all', array('conditions' => array('MallCart.session_id' => session_id())));
		$totalPrice = '';
		foreach($cartList as $item){
			$totalPrice = $totalPrice + $item['MallGoods']['shop_price'] * $item['MallCart']['goods_num']; 
		}
		return sprintf('%01.2f', $totalPrice);
	}
	
	public function flush(){
		$this->deleteAll(array('MallCart.session_id' => session_id()));
	}
}