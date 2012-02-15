<?php
class MallBrandsController extends AppController{
	var $uses = array('MallBrand');
	var $paginate = array(
		'limit' => 20,
		'order' => array('MallBrand.id' => 'DESC')
	);
	
	public function index(){
		$this->MallBrand->recursive = -1;
		$list = $this->paginate('MallBrand');
		$this->set('list', $list);
	}
	
	/*
	 * 添加、编辑
	 */
	public function edit($id = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->MallBrand->id = $id;
				$this->MallBrand->recursive = -1;
				$this->data = $this->MallBrand->read();
			}
		}
		else{
			if(empty($id) AND $this->MallBrand->find('count', array('conditions' => array('MallBrand.title' => $this->data['MallBrand']['title'])))){
				$this->flash('品牌 ' . $this->data['MallBrand']['title'] . ' 已经存在！','/MallBrands/index');
			}
			elseif ($this->MallBrand->save($this->data)){
				$this->flash('成功编辑品牌','/MallBrands/index');
			}
			else{
				$this->flash('编辑品牌失败！', '/MallBrands/index');
			}
		}
	}
}