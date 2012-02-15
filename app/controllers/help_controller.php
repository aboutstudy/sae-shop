<?php 
class HelpController extends AppController {
	var $uses = array('Help', 'HelpType');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
		$this->set('title_for_layout', '帮助中心');
	}
	
	public function index($help_type = null){
		
	}
	
	public function view($help_type = 1, $id = 1){
		$this->Help->id = $id;
		$this->data = $this->Help->read();
		
		//获取同类列表
		$helpList = $this->Help->getOthers($help_type, null, $id, 1);
		$this->set('helpList', $helpList);
	}
}
?>