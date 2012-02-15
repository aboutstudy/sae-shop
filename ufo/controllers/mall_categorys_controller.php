<?php
class MallCategorysController extends AppController{
	var $uses = array('MallCategory');
	var $paginate = array(
		'limit' => 20,
		'order' => array('MallCategory.id' => 'ASC')
	);
	
	public function index(){
		$this->MallCategory->recursive = 0;
		$list = $this->paginate('MallCategory');
		$this->set('list', $list);
	}
	
	/*
	 * 添加、编辑版块
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->MallCategory->id = $id;
				$this->MallCategory->recursive = -1;
				$this->data = $this->MallCategory->read();
			}
			$mallCatTypeList = $this->MallCategory->MallCatType->find('list');
			$this->set('mallCatTypeList', $mallCatTypeList);
		}
		else{
			if(empty($id) AND $this->MallCategory->find('count', array('conditions' => array('MallCategory.title' => $this->data['MallCategory']['title'])))){
				$this->flash('分类 ' . $this->data['MallCategory']['title'] . ' 已经存在！','/MallCategorys/index');
			}
			elseif($this->MallCategory->save($this->data)){
				$this->flash('成功编辑分类','/MallCategorys/index');
			}
			else{
				$this->flash('编辑分类失败！', '/MallCategorys/index');
			}
		}
	}
}