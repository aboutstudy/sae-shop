<?php
class MallExpressController extends AppController{
	var $uses = array('MallExpress');
	var $paginate = array(
		'limit' => 20
	);
	
	public function index(){
		$list = $this->paginate('MallExpress');
		$this->set('list', $list);
	}
	
	/*
	 * 添加、编辑
	 */
	public function edit($id = null, $parent_id = null, $region_type = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->MallExpress->id = $id;
				$this->MallExpress->recursive = -1;
				$this->data = $this->MallExpress->read();
			}			
		}
		else{
			if($this->MallExpress->save($this->data)){
				$this->flash('成功编辑配送方式','/MallExpress/index');
			}
			else{
				$this->flash('编辑配送方式失败！', '/MallExpress/index');
			}
		}
	}	
	
}