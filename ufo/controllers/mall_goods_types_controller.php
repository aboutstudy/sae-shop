<?php
class MallGoodsTypesController extends AppController{
	var $uses = array('MallGoodsType');
	var $paginate = array(
		'limit' => 20,
		'order' => array('MallGoodsType.id' => 'ASC')
	);
	
	public function index(){
		$this->MallGoodsType->recursive = -1;
		$list = $this->paginate('MallGoodsType');
		$this->set('list', $list);
	}
	
	/*
	 * 添加、编辑
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->MallGoodsType->id = $id;
				$this->MallGoodsType->recursive = -1;
				$this->data = $this->MallGoodsType->read();
			}
		}
		else{
			if($this->MallGoodsType->save($this->data)){
				$this->flash('成功编辑分类','/MallGoodsTypes/index');
			}
			else{
				$this->flash('编辑分类失败！', '/MallGoodsTypes/index');
			}
		}
	}
}