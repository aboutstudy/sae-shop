<?php
class HelpTypesController extends AppController{
	var $uses = array('HelpType');
	var $paginate = array(
		'limit' => 20,
		'order' => array('HelpType.id' => 'DESC')
	);
	
	public function index(){
		$list = $this->paginate('HelpType');
		$this->set('list', $list);		
	}
	
	/*
	 * 添加、编辑分类
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->HelpType->id = $id;
				$this->data = $this->HelpType->read();
			}
		}
		else{
			$hasOne = $this->HelpType->findByTitle($this->data['HelpType']['title']);
//			print_r($hasOne);exit;
			if(!empty($hasOne['HelpType']) AND empty($this->data['HelpType']['id'])){
				$this->flash('已经存在分类：'.$this->data['HelpType']['title'],'/HelpTypes/index');
			}
			elseif(!empty($hasOne['HelpType']) AND $this->data['HelpType']['id'] <> $hasOne['HelpType']['id']){
				$this->flash('已经存在分类：'.$this->data['HelpType']['title'],'/HelpTypes/index');
			}
			elseif($this->HelpType->save($this->data)){
				$this->flash('成功编辑分类','/HelpTypes/index');
			}
			else{
				$this->flash('编辑标签分类！', '/HelpTypes/index');
			}
		}
	}
}