<?php
class CommentsController extends AppController{
	var $uses = array('ArticleWeibo', 'ArticleComment', 'VideoWeibo', 'VideoComment', 'MallGoodsComment');
	var $pagination = array(
		'limit' => 20
	);
		
	/**
	 * 页面跳转至新浪微博单条微博页面
	 * @param unknown_type $uid
	 * @param unknown_type $sid
	 */
	public function toWeibo($uid, $sid){
		$this->flash('即将离开豆壳网，进入新浪微博页面!', 'http://api.t.sina.com.cn/'.$uid.'/statuses/'.$sid, 2);
	}
		
	//百科评论管理
	public function articleList(){
		$this->paginate = array(
			'limit' => 20,
			'order' => array('ArticleComment.id' => 'DESC')
		);
		$list = $this->paginate('ArticleComment');
		$this->set('list', $list);		
	}

	//视频评论管理
	public function videoList(){
		$this->paginate = array(
			'limit' => 20,
			'order' => array('VideoComment.id' => 'DESC')
		);		
		$list = $this->paginate('VideoComment');
		$this->set('list', $list);		
	}
		
	//商品评论管理
	public function goodsList(){
		$this->paginate = array(
			'limit' => 20,
			'order' => array('MallGoodsComment.id' => 'DESC')
		);
		$list = $this->paginate('MallGoodsComment');
		$this->set('list', $list);
	}	
	
	public function delete($type, $id){
		switch($type){
			case 'article':
				$model = $this->ArticleComment;
				break;
			case 'video':
				$model = $this->VideoComment;
				break;
			case 'goods':
				$model = $this->MallGoodsComment;
				break;		
		}
		if($model){
			if($model->delete($id)){
				$this->flash('成功删除评论', $this->referer(), 3);
			}
			else{
				$this->flash('删除评论失败', $this->referer(), 3);
			}
		}
	}
	public function flushComment(){	
		if(empty($this->data['Weibo'])){
			
		}
		else{
			//优先读取缓存数据
//			if(Cache::read('S_WB_BK_'.$this->Article->id) === false){
			if(1){
				//获取微博回评信息
				App::import('Vendor', 'weibooauth');
				$accessToken = $this->Session->read('sina.accessToken');
				$sClient = new WeiboClient(WB_AKEY, WB_SKEY, $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
		
				/*
				//获取微博 sid
				$mid = substr($this->data['Weibo']['mid'], strrpos($this->data['Weibo']['mid'], '/') + 1);	
					
				$jsonSID = _cURL("http://api.t.sina.com.cn/queryid.json?mid=$mid&isBase62=1&type=1");
				$sid = json_decode($jsonSID);
				*/
//				if(isset($sid->id)){
				if($this->data['Weibo']['sid']){
//					$replyList = $sClient->get_comments_by_sid($sid->id);
					$replyList = $sClient->get_comments_by_sid($this->data['Weibo']['sid']);
				}
				else{
					$replyList = array();
				}
				
				if (isset($replyList['error'])){
					$replyList = array();	
				}	
				else{
					Cache::write('S_WB_BK_'.$this->Article->id, $replyList);
				}			
			}
			else{
				//读取缓存
				$replyList = Cache::read('S_WB_BK_'.$this->Article->id);
				if (isset($replyList['error'])){
					$replyList = array();	
				}				
			}				
		}
	}
}