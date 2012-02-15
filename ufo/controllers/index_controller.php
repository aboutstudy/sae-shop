<?php
class IndexController extends AppController{
	var $uses = array('User');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index', 'index');
	}
	
	public function index(){
		
	}
}