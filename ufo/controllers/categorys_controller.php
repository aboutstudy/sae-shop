<?php
class CategorysController extends AppController{
	var $uses = array('Category');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Category.id' => 'DESC')
	);
	
	public function index(){
		$arrCategorys = $this->paginate('Category');
		$this->set('arrCategorys', $arrCategorys);		
	}
	
	public function edit($category_id = null){
		if(empty($this->data)){
			if(isset($category_id)){
				$this->Category->id = $category_id;
				$this->Category->recursive = -1;
				$this->data = $this->Category->read();
			}
		}
		else{
			if($this->Category->save($this->data)){
				$this->flash('成功编辑分类','/categorys/index');
			}
			else{
				$this->flash('编辑分类失败！', '/categorys/index');
			}
		}
	}
}