<?php
class UcController extends AppController{
	var $uses = array('User', 'ArticleComment', 'VideoComment', 'MallCart', 'MallOrder');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$user = $this->Auth->user();		
		if(empty($user['User']['username'])){
			$this->flash('在豆壳安家得有个超有范的昵称吧~', '/users/setting');
		}
		$this->set('title_for_layout', '我的豆壳');
		$this->layout = 'uc';
	}
	
	public function beforeRender(){
////		计算购物车中商品数量 		
//		$cart_count = $this->MallCart->find('count', array('conditions' => array('MallCart.session_id' => session_id())));
//		$this->set('cart_count', $cart_count);		
	}
		
	//会员中心首页
	public function index(){
		//获取会员信息
		$this->User->id = $this->Auth->user('id');
		$user = $this->User->read();
		$user['User']['myface'] = empty($user['User']['myface']) ? '/images/default_face.jpg' : $user['User']['myface'];
		$this->set('user', $user);

		//获取订单信息
		$order_list = $this->MallOrder->find('all', array('conditions' => array('MallOrder.user_id' => $user['User']['id']), 'order' => array('MallOrder.id' => 'DESC'), 'limit' => 5));
		
		//处理订单信息代码
		foreach($order_list as $num => $order){
			$order_list[$num]['MallOrder']['order_status_name'] = $this->MallOrder->getStatus('order_status', $order['MallOrder']['order_status']);
			$order_list[$num]['MallOrder']['pay_status_name'] = $this->MallOrder->getStatus('pay_status', $order['MallOrder']['pay_status']);
		}
		$this->set('order_list', $order_list);		
	}
	
	//我的收藏（视频）
	public function favorite(){
		
	}
	
	/**
	 * 查看已经发布的评论
	 * @param unknown_type $type
	 */
	public function comment($type = NULL){
		$user = $this->Auth->user();
		
		if(!empty($user['User']['username'])){
			if($type == 'baike' OR is_null($type)){
				$this->paginate = array(
					'conditions' => array('User.id' => $user['User']['id']),
					'order' => array('ArticleComment.id' => 'DESC'),
					'limit' => 5
				);
				$list = $this->paginate('ArticleComment');	
				$this->set('list', $list);
				$this->render('/uc/commentForBaiKe');			
			}
			elseif ($type == 'video'){
				$this->paginate = array(
					'conditions' => array('User.id' =>  $user['User']['id']),
					'order' => array('VideoComment.id' => 'DESC'),
					'limit' => 5
				);
				$list = $this->paginate('VideoComment');	
				$this->set('list', $list);
				$this->render('/uc/commentForVideo');			
			}			
		}
	}
}