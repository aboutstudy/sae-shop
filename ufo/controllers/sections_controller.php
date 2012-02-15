<?php
class SectionsController extends AppController{
	var $uses = array('Section');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Section.id' => 'ASC')
	);
	
	public function index(){
		$this->Section->recursive = -1;
		$arrList = $this->paginate('Section');
		$this->set('arrList', $arrList);
	}
	
	/*
	 * 添加、编辑版块
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->Section->id = $id;
				$this->Section->recursive = -1;
				$this->data = $this->Section->read();
			}
		}
		else{
			if($this->Section->save($this->data)){
				$this->flash('成功编辑版块','/sections/index');
			}
			else{
				$this->flash('编辑版块失败！', '/sections/index');
			}
		}
	}
}