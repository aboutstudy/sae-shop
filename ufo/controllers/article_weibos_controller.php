<?php
class ArticleWeibosController extends AppController{
	var $uses = array('Article', 'ArticleWeibo');
	
	/**
	 * 内容发布：发布内容关联微博、更新内容状态为前台显示
	 * @param unknown_type $id 内容ID
	 */
	public function publish($id){		
		if(empty($this->data)){
			$this->data['ArticleWeibo']['article_id'] = $id;
			$this->Article->recursive = -1;
			$article = $this->Article->findById($id);
			$this->data['Article'] = $article['Article'];
			
			$this->set('id', $id);
			
			//马甲信息
			$faker = $this->Session->read('Faker.sina');
			$this->set('Faker', $faker);			
		}
		else{
			//发微博
			App::import('Vendor', 'weibooauth');
			$accessToken = $this->Session->read('Faker.sina');
			
			$sClient = new WeiboClient(WB_AKEY, WB_SKEY, $accessToken['Sina']['oauth_token'], $accessToken['Sina']['oauth_token_secret']);
//			$return = $sClient->upload('豆壳网 - 让女人更懂美！ http://www.doucl.com/baike/view/'.$id, 'http://www.doucl.com/images/vi.jpg');
			
			$this->data['ArticleWeibo']['img'] = trim($this->data['ArticleWeibo']['img']);
			if(empty($this->data['Article']['title'])){
				$weibo = $sClient->upload($this->data['ArticleWeibo']['content']." 详细阅读 >>>http://".$_SERVER['HTTP_HOST'].'/baike/view/'.$id.' 豆壳网 - 让女人更懂美！', $this->data['ArticleWeibo']['img']);	
			}
			else{
				$weibo = $sClient->upload($this->data['ArticleWeibo']['content']." 【".$this->data['Article']['title']."】详细阅读 >>>http://".$_SERVER['HTTP_HOST'].'/baike/view/'.$id.' 豆壳网 - 让女人更懂美！', $this->data['ArticleWeibo']['img']);				
			}
			if(isset($weibo['error'])){
				$this->flash('微博发布失败:' . $weibo['error'], '/weibos/publish/'.$id);
			}
			else{
				//保存微博与内容关联				
				$this->data['ArticleWeibo']['member_id'] = $accessToken['Sina']['member_id'];
				$this->data['ArticleWeibo']['sid'] = $weibo['id'];
				$this->data['ArticleWeibo']['uid'] = $weibo['user']['id'];
				$this->data['ArticleWeibo']['img'] = $weibo['original_pic'];
				$data = array();
				if($this->ArticleWeibo->save($this->data)){
					$this->Article->id = $id;
					$data['Article']['member_id'] = $accessToken['Sina']['member_id'];
					$data['Article']['user_id'] = $this->Auth->user('id');
					$data['Article']['status'] = $this->data['Article']['status'];
					$this->Article->save($data);
										
//					print_r($weibo);exit;
					$this->flash('微博发布成功', '/articles/index/0');
				}				
				else{
					$this->flash('保存微博失败，微博发布成功', '/weibos/publish/'.$id);
				}
			}						
		}		
	}
	
	public function update(){			
		if(empty($this->data)){
			//马甲信息
			$faker = $this->Session->read('Faker.sina');			
			if(empty($faker)){
				$this->flash('未设置操作马甲账号，请先设置', '/sinas/fakerList');
			}
			else{
				$this->set('Faker', $faker);	
			}			
		}
		else{
			//发微博
			App::import('Vendor', 'weibooauth');
			$accessToken = $this->Session->read('Faker.sina');
			
			$sClient = new WeiboClient(WB_AKEY, WB_SKEY, $accessToken['Sina']['oauth_token'], $accessToken['Sina']['oauth_token_secret']);
//			$return = $sClient->upload('豆壳网 - 让女人更懂美！ http://www.doucl.com/baike/view/'.$id, 'http://www.doucl.com/images/vi.jpg');
			
			$this->data['ArticleWeibo']['img'] = trim($this->data['ArticleWeibo']['img']);
			if(empty($this->data['ArticleWeibo']['img'])){
				$weibo = $sClient->update($this->data['ArticleWeibo']['content'].' 豆壳网 - 让女人更懂美！');
			}
			else{
				$weibo = $sClient->upload($this->data['ArticleWeibo']['content'].' 豆壳网 - 让女人更懂美！', $this->data['ArticleWeibo']['img']);
			}
			
			if(isset($weibo['error'])){
				$this->flash('微博发布失败:' . $weibo['error'], '/ArticleWeibos/update');
			}
			else{
				$this->flash('微博发布成功', '/ArticleWeibos/update');
			}						
		}		
	}	
}