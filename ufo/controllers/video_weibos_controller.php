<?php
class VideoWeibosController extends AppController{
	var $uses = array('Video', 'VideoWeibo');
	
	/**
	 * 内容发布：发布内容关联微博、更新内容状态为前台显示
	 * @param unknown_type $id 内容ID
	 */
	public function publish($id){		
		if(empty($this->data)){
			$this->data['VideoWeibo']['video_id'] = $id;
			$this->set('id', $id);
			
			$this->Video->recursive = -1;
			$video = $this->Video->findById($id);
			$this->data['Video'] = $video['Video'];			
			
			//马甲信息
			$faker = $this->Session->read('Faker.sina');
			$this->set('Faker', $faker);			
		}
		else{
			//发微博
			App::import('Vendor', 'weibooauth');
			$accessToken = $this->Session->read('Faker.sina');			
			$sClient = new WeiboClient(WB_AKEY, WB_SKEY, $accessToken['Sina']['oauth_token'], $accessToken['Sina']['oauth_token_secret']);			
			$this->data['VideoWeibo']['img'] = trim($this->data['VideoWeibo']['img']);
			if(empty($this->data['Video']['title'])){
				$weibo = $sClient->upload($this->data['VideoWeibo']['content']." 详细阅读 >>>http://".$_SERVER['HTTP_HOST'].'/Video/view/'.$id.' #豆壳网 - 让女人更懂美！# ', $this->data['VideoWeibo']['img']);	
			}
			else{
				$weibo = $sClient->upload($this->data['VideoWeibo']['content']." 【".$this->data['Video']['title']."】详细阅读 >>>http://".$_SERVER['HTTP_HOST'].'/Video/view/'.$id.' #豆壳网 - 让女人更懂美！# ', $this->data['VideoWeibo']['img']);
			}
			
			if(isset($weibo['error'])){
				$this->flash('微博发布失败:' . $weibo['error'], '/weibos/publish/'.$id);
			}
			else{
				//保存微博与内容关联				
				$this->data['VideoWeibo']['member_id'] = $accessToken['Sina']['member_id'];
				$this->data['VideoWeibo']['sid'] = $weibo['id'];
				$this->data['VideoWeibo']['uid'] = $weibo['user']['id'];
				$this->data['VideoWeibo']['img'] = $weibo['original_pic'];
				$data = array();
				if($this->VideoWeibo->save($this->data)){
					$this->Video->id = $id;
					$data['Video']['member_id'] = $accessToken['Sina']['member_id'];
					$data['Video']['user_id'] = $this->Auth->user('id');
					$data['Video']['status'] = $this->data['Video']['status'];
					$this->Video->save($data);
										
//					print_r($weibo);exit;
					$this->flash('微博发布成功', '/videos/index/0');
				}				
				else{
					$this->flash('保存微博失败，微博发布成功', '/weibos/publish/'.$id);
				}
			}						
		}		
	}
}