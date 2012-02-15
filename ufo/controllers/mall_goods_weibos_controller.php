<?php
class MallGoodsWeibosController extends AppController{
	var $uses = array('MallGoods', 'MallGoodsWeibo');
	
	/**
	 * 内容发布：发布内容关联微博、更新内容状态为前台显示
	 * @param unknown_type $id 内容ID
	 */
	public function publish($id){		
		if(empty($this->data)){
			$this->data['MallGoodsWeibo']['goods_id'] = $id;
			$this->set('id', $id);
			
			$this->MallGoods->recursive = -1;			
			$goods = $this->MallGoods->findById($id);
			$this->data['MallGoods'] = $goods['MallGoods']; 
			
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
			
			$this->data['MallGoodsWeibo']['img'] = trim($this->data['MallGoodsWeibo']['img']);
			if(empty($this->data['MallGoods']['title'])){
				$weibo = $sClient->upload($this->data['MallGoodsWeibo']['content']." 立即抢购 >>>http://".$_SERVER['HTTP_HOST'].'/Goods/view/'.$id.' 豆壳网 - 让女人更懂美！ ', $this->data['MallGoodsWeibo']['img']);	
			}
			else{
				$weibo = $sClient->upload($this->data['MallGoodsWeibo']['content']." 【".$this->data['MallGoods']['title']."】立即抢购 >>>http://".$_SERVER['HTTP_HOST'].'/Goods/view/'.$id.' 豆壳网 - 让女人更懂美！ ', $this->data['MallGoodsWeibo']['img']);
			}
			if(isset($weibo['error'])){
				$this->flash('微博发布失败:' . $weibo['error'], '/weibos/publish/'.$id);
			}
			else{
				//保存微博与内容关联				
				$this->data['MallGoodsWeibo']['member_id'] = $accessToken['Sina']['member_id'];
				$this->data['MallGoodsWeibo']['sid'] = $weibo['id'];
				$this->data['MallGoodsWeibo']['uid'] = $weibo['user']['id'];
				$this->data['MallGoodsWeibo']['img'] = $weibo['original_pic'];
				$data = array();
				if($this->MallGoodsWeibo->save($this->data)){
					$this->MallGoods->id = $id;
					$data['MallGoods']['member_id'] = $accessToken['Sina']['member_id'];
					$data['MallGoods']['user_id'] = $this->Auth->user('id');
					$data['MallGoods']['status'] = $this->data['MallGoods']['status'];
					$this->MallGoods->save($data);
										
//					print_r($weibo);exit;
					$this->flash('微博发布成功', '/MallGoods/index/0');
				}				
				else{
					$this->flash('保存微博失败，微博发布成功', '/MallGoodsWeibos/publish/'.$id);
				}
			}						
		}		
	}
}