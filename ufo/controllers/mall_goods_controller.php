<?php
class MallGoodsController extends AppController{
	var $uses = array('MallGoods', 'Tag');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $paginate = array(
		'limit' => 20,
		'order' => array('MallGoods.id' => 'DESC', 'MallGoods.sort_order' => 'DESC')
	);
	
	public function index($status = NULL){		
		if (is_null($status)){
			$list = $this->paginate('MallGoods');
		}
		else{
			$list = $this->paginate('MallGoods', array('MallGoods.status' => $status));	
		}
		$this->set('list', $list);
				
		$faker = $this->Session->read('Faker.sina');
		if(empty($faker)){
			$this->flash('未设置操作马甲账号，请先设置', '/sinas/fakerList');
		}
		else{
			$this->set('Faker', $faker);	
		}
	}
	
	/*
	 * 添加、编辑产品
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->MallGoods->id = $id;
				$this->MallGoods->recursive = 1;
				$this->data = $this->MallGoods->read();
				
				//处理标签
				$this->data['MallGoods']['strTags'] = '';
				if(!empty($this->data['Tag'])){
					foreach ($this->data['Tag'] as $tag){
						$this->data['MallGoods']['strTags'] .= $tag['title'] . ' '; 
					}					
				}
			
				//处理促销时间
				$this->data['MallGoods']['promote_start_time'] = date('Y-m-d', $this->data['MallGoods']['promote_start_time']);
				$this->data['MallGoods']['promote_end_time'] = date('Y-m-d', $this->data['MallGoods']['promote_end_time']);
			}
						
			//预处理数据
			$tags = $this->MallGoods->Tag->find('list');
			$this->set('tags', $tags);
			
			$categorys = $this->MallGoods->MallCategory->find('list');
			$this->set('categorys', $categorys);
			
			$sections = $this->MallGoods->MallSection->find('list');
			$this->set('sections', $sections);
			
			$goods_types = $this->MallGoods->MallGoodsType->find('list');
			$this->set('goods_types', $goods_types);
			
			$goods_brands = $this->MallGoods->MallBrand->find('list');
			$this->set('goods_brands', $goods_brands);
			
//			print_r($this->data);exit;			
		}
		else{
//			print_r($this->data);exit;
			//处理促销时间
			$this->data['MallGoods']['promote_start_time'] = strtotime($this->data['MallGoods']['promote_start_time']);
			$this->data['MallGoods']['promote_end_time'] = strtotime($this->data['MallGoods']['promote_end_time']); 
			
			$this->data['Tag']['Tag'] = @$this->Tag->checkAdd($this->data['MallGoods']['strTags']);
//			print_r($this->data);exit;
			if($this->MallGoods->saveAll($this->data)){
				$this->flash('成功编辑商品','/MallGoods/index');
			}
			else{
				$this->flash('编辑商品失败！', '/MallGoods/index');
			}
		}
	}
	
	public function view($id){
		$this->redirect('http://'.$_SERVER['HTTP_HOST'].'/Goods/view/' . $id);
	}
	
	public function delete($id){
		if($this->MallGoods->delete($id)){
			$this->flash('删除成功', '/MallGoods/index/');
		}
		else{
			$this->flash('删除失败', '/MallGoods/index/');
		}
	}
	
	public function setSortOrder($id, $value){
		$this->autoRender = false;		
		
		$response = array();
		$this->MallGoods->id = $id;
		if($this->MallGoods->saveField('sort_order', $value)){
			$response['success'] = 1;
			$response['msg'] = '成功更新排序';
		}
		else{
			$response['error'] = 1;
			$response['msg'] = '更新失败';
		}
		
		$response = json_encode($response);
		echo $response;
	}
}