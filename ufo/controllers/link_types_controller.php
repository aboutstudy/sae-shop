<?php
class LinkTypesController extends AppController{
	var $uses = array('LinkType');
	var $paginate = array(
		'limit' => 20,
		'order' => array('LinkType.id' => 'ASC')
	);
	
	public function index(){
		$this->LinkType->recursive = -1;
		$list = $this->paginate('LinkType');
		$this->set('list', $list);
	}
	
	/*
	 * 添加、编辑
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->LinkType->id = $id;
				$this->LinkType->recursive = -1;
				$this->data = $this->LinkType->read();
			}
		}
		else{
			if($this->LinkType->save($this->data)){
				$this->flash('成功编辑分类','/LinkTypes/index');
			}
			else{
				$this->flash('编辑分类失败！', '/LinkTypes/index');
			}
		}
	}
}