<?php
class MallController extends AppController{
	var $uses = array('MallGoods', 'MallCategory', 'MallSection', 'MallCatType', 'Link', 'Help', 'MallCart');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
		$this->layout = 'mall_home';		
	}
	
	public function beforeRender(){
//		计算购物车中商品数量 
//		$cart_count = $this->MallCart->find('count', array('conditions' => array('MallCart.session_id' => session_id())));
//		$this->set('cart_count', $cart_count);		
	}
		
	public function index(){
		//获取推荐产品
		$recommendList = $this->MallSection->findById(1);
		$this->set('recommendList', $recommendList);
		
		//获取畅销产品
		$hotList = $this->MallSection->findById(2);
		$this->set('hotList', $hotList);
		
		//获取销量TOP榜
		$saleTopList = $this->MallSection->findById(3);
		$this->set('saleTopList', $saleTopList);
		
		//获取分类类型及相关分类列表信息
		$catTypeList = $this->MallCatType->find('all');
		$this->set('catTypeList', $catTypeList);
		
		$this->Link->recursive = -1;
		$focusList = $this->Link->find('all', array('conditions' => array('Link.type_id' => 1), 'order' => array('Link.sort_order' => 'DESC', 'Link.id' => 'DESC'), 'limit' => 3));
		$this->set('focusList', $focusList);

		//获取最新动态
		$newsList = $this->Help->getOthers(3, 7);
		$this->set('newsList', $newsList);
		
		$this->set('title_for_layout', '豆壳商城 - 女性时尚正品购物网站');		
	}
}
?>