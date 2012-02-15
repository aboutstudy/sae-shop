<?php
class HelpsController extends AppController{
	var $uses = array('Help', 'HelpType');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Help.id' => 'DESC')
	);
	
	public function index($help_type = NULL){		
		if (is_null($help_type)){
			$list = $this->paginate('Help');
		}
		else{
			$list = $this->paginate('Help', array('Help.help_type_id' => $help_type));	
		}	
		
		$this->set('list', $list);
	}
	
	/*
	 * 添加、编辑文章
	 */
	public function edit($help_id = null){
		if(empty($this->data)){
			if(isset($help_id)){
				$this->Help->id = $help_id;
				$this->data = $this->Help->read();				
			}
						
			//预处理数据
			$arrHelpType = $this->HelpType->find('list');
			$this->set('arrHelpType', $arrHelpType);
//			print_r($this->data);exit;			
		}
		else{
//			print_r($this->data);exit;
			if($this->Help->saveAll($this->data)){
				$this->flash('成功编辑帮助','/Helps/index');
			}
			else{
				$this->flash('编辑帮助失败！', '/Helps/index');
			}
		}
	}
	
	public function view($help_type = 1, $id = 1){
		$this->redirect('http://'.$_SERVER['HTTP_HOST'].'/Help/view/' . $help_type . '/' . $id);
	}
}