<?php
class GoodsController extends AppController{
	var $uses = array('MallGoods', 'MallCategory', 'MallSection', 'MallGoodsCategorys', 'MallCatType', 'MallCart', 'MallGoodsComment');
	var $paginate = array(
		'order' => array('MallGoods.sort_order' => 'DESC'),
		'limit' => 16
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
				
		$this->layout = 'mall';
	}
	
	public function beforeRender(){
		$cart_count = $this->MallCart->find('count', array('conditions' => array('MallCart.session_id' => session_id())));
		$this->set('cart_count', $cart_count);		
	}
		
	/**
	 * 浏览商品
	 * @param unknown_type $id
	 */
	public function view($id){
		$this->MallGoods->id = $id;
		$this->MallGoods->recursive = 1;
		$this->data = $this->MallGoods->read();
		
		//获取销量TOP榜
		$saleTopList = $this->MallSection->findById(3);
		$this->set('saleTopList', $saleTopList);		
		
		//获取分类类型及相关分类列表信息
		$catTypeList = $this->MallCatType->find('all');
		$this->set('catTypeList', $catTypeList);		
		
//		if($commentList === false){
		if(1){
			$this->MallGoodsComment->recursive = 0;
			$this->paginate['limit'] = 10;
			$this->paginate['order'] = array('MallGoodsComment.created' => 'DESC');
			$commentList = $this->paginate('MallGoodsComment', array('MallGoodsComment.goods_id' => $id));
			//Cache::write('COMMENT_BK_'.$id, $commentList);			
		}		
		$this->set('commentList', $commentList);		
		
		$arrKeywords = array();
		foreach($this->data['Tag'] as $tag){
			$arrKeywords[] = $tag['title'];
		}
		foreach($this->data['MallCategory'] as $category){
			$arrKeywords[] = $category['title'];
		}
		
		$this->set('meta_keywords', $this->data['MallGoods']['short_title'] . implode(',', $arrKeywords));
		$this->set('meta_description', $this->data['MallGoods']['title'] . implode(' ', $arrKeywords));
		
		$this->set('title_for_layout', $this->data['MallGoods']['title']);
	}
	
	public function search(){
		//SEO 关键词
		$keyword_for_head = '';
		
		if(isset($this->params['named']['tag'])){
			$list = $this->paginate('MallGoodsTags', array('Tag.title' => $this->params['named']['tag']));
			$this->set('keyword', $this->params['named']['tag']);
			$keyword_for_head = $this->params['named']['tag'];
		}
		else if(isset($this->params['named']['category'])){
			$list = $this->paginate('MallGoodsCategorys', array('MallCategory.title' => $this->params['named']['category']));
			$this->set('keyword', $this->params['named']['category']);
			$keyword_for_head = $this->params['named']['category'];
		}
		else{
			$this->MallGoods->recursive = -1;
			$list = $this->paginate('MallGoods');
			$this->set('keyword', '全部');
			$keyword_for_head = '全部产品列表';
		}		
		$this->set('list', $list);	
		
		//获取销量TOP榜
		$saleTopList = $this->MallSection->findById(3);
		$this->set('saleTopList', $saleTopList);	
		
		//获取分类类型及相关分类列表信息
		$catTypeList = $this->MallCatType->find('all');
		$this->set('catTypeList', $catTypeList);		
		
		$this->set('title_for_layout', $keyword_for_head);
	}
}
?>