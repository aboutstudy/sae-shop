<?php
class MallCatTypesController extends AppController{
	var $uses = array('MallCatType');
	var $paginate = array(
		'limit' => 20,
		'order' => array('MallCatType.id' => 'ASC')
	);
	
	public function index(){
		$this->MallCatType->recursive = -1;
		$list = $this->paginate('MallCatType');
		$this->set('list', $list);
	}
	
	/*
	 * 添加、编辑
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->MallCatType->id = $id;
				$this->MallCatType->recursive = -1;
				$this->data = $this->MallCatType->read();
			}
		}
		else{
			if($this->MallCatType->save($this->data)){
				$this->flash('成功编辑分类','/MallCatTypes/index');
			}
			else{
				$this->flash('编辑分类失败！', '/MallCatTypes/index');
			}
		}
	}
}