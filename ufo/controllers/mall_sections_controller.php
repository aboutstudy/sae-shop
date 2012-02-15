<?php
class MallSectionsController extends AppController{
	var $uses = array('MallSection');
	var $paginate = array(
		'limit' => 20,
		'order' => array('MallSection.id' => 'ASC')
	);
	
	public function index(){
		$this->MallSection->recursive = -1;
		$list = $this->paginate('MallSection');
		$this->set('list', $list);
	}
	
	public function goodsList($mall_section){
		$list = $this->paginate('MallSection', array('MallSection.id' => $mall_section));
		$this->set('list', $list[0]);
	}
	/*
	 * 添加、编辑版块
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->MallSection->id = $id;
				$this->MallSection->recursive = -1;
				$this->data = $this->MallSection->read();
			}
		}
		else{
			if($this->MallSection->save($this->data)){
				$this->flash('成功编辑版块','/MallSections/index');
			}
			else{
				$this->flash('编辑版块失败！', '/MallSections/index');
			}
		}
	}
}