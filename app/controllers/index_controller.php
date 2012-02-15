<?php
class IndexController extends AppController{
	var $uses = array('Article', 'Video', 'Section', 'Tag', 'Category', 'UserTag', 'Link', 'MallSection');
	var $helpers = array('Cache');	
	var $cacheAction = array(
//	  'index' => 1800
	);	 
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	public function index(){
		//首页大图视频信息获取
		$section_01 = $this->Section->findById('1');
		$this->set('section_01', $section_01);
		
		//首页顶部视频头条
		$section_02 = $this->Section->findById('2');
		$this->set('section_02', $section_02);
		
		//首页顶部主推视频
		$section_03 = $this->Section->findById('3');
		$section_03['List'] = array_chunk($section_03['Video'], 4);		
		$this->set('section_03', $section_03);

		//首页顶部美丽百科头条
		$section_04 = $this->Section->findById('4');
		$this->set('section_04', $section_04);
		
		//首页顶部推荐百科
		$section_05 = $this->Section->findById('5');
		$this->set('section_05', $section_05);
		
		//首页视频课堂
		$section_06 = $this->Section->findById('6');
		$this->set('section_06', $section_06);
		
		//首页美容护肤版块
		$section_07 = $this->Section->findById('7');
		$this->set('section_07', $section_07);
		//版块头条
		$section_08 = $this->Section->findById('8');
		$this->set('section_08', $section_08);

		//首页美体健康版块
//		$section_09 = $this->Section->findById('9');
//		$this->set('section_09', $section_09);
		
		//版块头条
		$section_10 = $this->Section->findById('10');
		$this->set('section_10', $section_10);				
		
		//获取"前台推荐-美容护肤"会员		
		$user_tag_01 = $this->UserTag->findById(3);
		$this->set('user_tag_01', $user_tag_01);

		//获取"前台推荐-美体养生"会员		
//		$user_tag_02 = $this->UserTag->findById(4);
//		$this->set('user_tag_02', $user_tag_02);
		
		//获取商城热卖
		$mall_hot = $this->MallSection->findById(5);;
		$mall_hot = array_chunk($mall_hot['MallGoods'], 3);
		$mall_hot = $mall_hot[0];
		$this->set('mall_hot', $mall_hot);

		//获取商城热卖(大)
		$mall_hot_big = $this->Link->find('first', array('conditions' => array('Link.type_id' => 4), 'limit' => 1, 'order' => array('Link.sort_order' => 'DESC')));
		$this->set('mall_hot_big', $mall_hot_big['Link']);		
				
		$this->set('title_for_layout', '豆壳网 - 让女人更懂美！');
		$this->layout = 'home';
	}
}