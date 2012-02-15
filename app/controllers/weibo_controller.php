<?php
class WeiboController extends AppController{
	var $uses = array('ArticleWeibo', 'ArticleComment', 'VideoWeibo', 'VideoComment', 'MallGoodsComment');
	var $pagination = array(
		'limit' => 20
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	
	/**
	 * 页面跳转至新浪微博单条微博页面
	 * @param unknown_type $uid
	 * @param unknown_type $sid
	 */
	public function toWeibo($uid, $sid){
		$this->flash('即将离开豆壳网，进入新浪微博页面!', 'http://api.t.sina.com.cn/'.$uid.'/statuses/'.$sid, 2);
	}
		
	public function comment(){
		$userAuth = $this->Auth->user();
		
		//登陆判断
		if(empty($userAuth)){
			$response = array('error' => 1, 'msg' => '请先登陆', 'url' => '/Users/login/');
			echo json_encode($response);
			exit;
		}

		//设置暂未有头像会员默认图像
		if(empty($userAuth['User']['myface'])){
			$userAuth['User']['myface'] = '/images/default_face.jpg';
		}
				
		$sType = $this->params['url']['sType'];		//评论对象类型:1-百科, 2-视频
		$text = trim($this->params['url']['text']);
		$sid = $this->params['url']['sid'];
		$mid = $this->params['url']['mid'];
		$cid = NULL;	//$this->params['url']['cid'];
		$isRepost = $this->params['url']['isRepost'];
		$isFollow = $this->params['url']['isFollow'];
		$uid = $this->params['url']['uid'];
				
		//发微博
		$sClient = getSTClient();
		
		if(!empty($sClient)){
			//关注处理
			if($isFollow == 'true'){
				$sClient->follow($uid);
			}
			
			//转发评论
			if($isRepost == 'true'){
				$comment = $sClient->repost($sid, $text, 3);	
			}
			else {	//一般评论
				$comment = $sClient->send_comment($sid, $text, $cid);
			}			
		}
		else{
			$comment['error'] = 1;
		}		
		
		//评论处理
		$comment_id = 0;
		if($sType == 'baike'){			
			if(!isset($comment['error'])){
				$comment_id = $comment['id'];
				//更新评论缓存
				/*
				$this->ArticleComment->recursive = 0;
				$this->paginate = array('order' => array('ArticleComment.id' => 'DESC'));
				$commentList = $this->paginate('ArticleComment', array('ArticleComment.article_id' => $mid));
				Cache::write('COMMENT_BK_'.$mid, $commentList);
				*/			
			}
			
			$data['ArticleComment'] = array(
				'article_id' => $mid,
				'member_id' => $this->Auth->user('id'),
				'sid' => $sid,
				'content' => $text,
				'cid' => $comment_id
			);
			$this->ArticleComment->save($data);					
		}
		elseif ($sType == 'video'){			
			if(!isset($comment['error'])){
				$comment_id = $comment['id'];				
				//更新评论缓存
				/*
				$this->VideoComment->recursive = 0;
				$this->paginate = array('order' => array('VideoComment.id' => 'DESC'));
				$commentList = $this->paginate('VideoComment', array('VideoComment.video_id' => $mid));
				Cache::write('COMMENT_VIDEO_'.$mid, $commentList);
				*/			
			}
			
			$data['VideoComment'] = array(
				'video_id' => $mid,
				'member_id' => $this->Auth->user('id'),
				'sid' => $sid,
				'content' => $text,
				'cid' => $comment_id
			);
			$this->VideoComment->save($data);
		}
		elseif ($sType == 'goods'){			
			if(!isset($comment['error'])){
				$comment_id = $comment['id'];			
			}
			
			$data['MallGoodsComment'] = array(
				'goods_id' => $mid,
				'member_id' => $this->Auth->user('id'),
				'sid' => $sid,
				'content' => $text,
				'cid' => $comment_id
			);
			$this->MallGoodsComment->save($data);
		}
		
			
		//返回最新评论
		$response = '
			<div class="reply last item" >
				<div class="img face"><a href="http://weibo.com/n/'.$userAuth['User']['username'].'"><img width="50" height="50" alt="'.$userAuth['User']['username'].'" src="'.$userAuth['User']['myface'].'"></a></div>
				<div class="contentBody">
					<div class="pointer">&nbsp;</div>
					<div class="published">
						<span class="time">发布于 刚刚</span>				
						<div><a class="red bold" href="http://weibo.com/n/'.$userAuth['User']['username'].'">'.$userAuth['User']['username'].'</a></div>
					</div>
					<div class="content">'.$text.'</div>
				</div>
				<div class="div_c"></div>
			</div>		
		';
					
		$response = array(
			'error' => 0,
			'result' => $response
		);
		
		echo json_encode($response);		
		$this->autoRender = false;		
	}
	public function reply($id, $sid){
		
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