<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Session', 'Text');	
	var $components = array('Auth', 'Session');
	var $uses = array('Tag', 'Category', 'Section', 'Video', 'Article', 'User');
	
	public function beforeFilter(){
		$this->Auth->fields = array('username' => 'email', 'password' => 'password');
		
		$this->Auth->loginRedirect = array('controller' => 'uc', 'action' => 'index');
		$this->Auth->logoutRedirect = array('controller' => 'uc', 'action' => 'index');
		
		$this->Auth->loginError = "账号或密码错误！";
		$this->Auth->authError = "请先登陆后操作！";	
		
		//获取标签列表
		$this->Tag->recursive = -1;
		$tagsIndex = $this->Tag->find('all', array('conditions' => array('Tag.type >= ' => 2)));
		$this->set('tagsIndex', $tagsIndex);
				
		//获取分类
		$this->Category->recursive = -1;
		$categorysIndex = $this->Category->find('all');
		$this->set('categorysIndex', $categorysIndex);	

		//人气榜视频		
		$section_12 = $this->Section->findById(12);
		$this->set('section_12', $section_12);	

		//获取总视频数
		$videoCount = $this->Video->find('count');
		$this->set('videoCount', $videoCount);
		
		//获取总会员数
//		$userCount = $this->User->find('count');
//		$this->set('userCount', $userCount);		
	}
	public function beforeRender(){
		/*
		$user = $this->Auth->user();
		if(isset($user)){
			$this->set('isLogin', 1);
			$this->set('userInfo', $this->Auth->user());
		}
		*/
	}
}
