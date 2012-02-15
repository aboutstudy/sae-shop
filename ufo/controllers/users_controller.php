<?php
class UsersController extends AppController{
	var $uses = array('User');
	var $paginate = array(
		'limit' => '20',
		'order' => array('User.id' => 'DESC')
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('login');
	}
	public function index(){
		$this->User->recursive = 0;
		//此部分只管理后台管理账号，代理商和终端在相应模块管理
		$arrUsers = $this->paginate('User');
		$this->set('arrUsers', $arrUsers);
	}
	
    public function login() {
    	if(!empty($this->data)){
    		$this->Auth->login($this->data);
    	}
    	else{
			if ($this->Session->read('UFO.User')) {
				$this->Session->setFlash('You are logged in!');
			}				    		
    	}
    	$this->redirect('/iframes/main', null, false);
    }

    public function logout() {
    	$this->Session->setFlash('已经安全退出');
        $this->redirect($this->Auth->logout());
    }
    //账号编辑	
	public function edit($user_id = null){
		if(empty($this->data)){	//编辑账号信息，提取资料
			if(!empty($user_id)){
				$this->User->id = $user_id;
				$this->data = $this->User->read();
				//处理加密后的密码问题
				unset($this->data['User']['password']);					
			}
		}
		else{	//添加新代理			
			//判断密码是否为空，为空则不修改密码。因为CakePHP的Auth组件会在这之前自动密码密码
			//字符串"7e69e1849eca3d3ef00e0eec4c712481e358b9e8"实际为“空”经过加密后结果
			if($this->data['User']['id']){	//只有在修改账号资料的时候才处理密码为空的问题
				if ($this->data['User']['password'] == '7e69e1849eca3d3ef00e0eec4c712481e358b9e8'){				
					unset($this->data['User']['password']);
				}	
			}		
			
			if($this->User->save($this->data)){
				$this->flash('编辑成功', '/users/index', 2);	
			}
			else{
				$this->flash('编辑失败', '/users/edit', 2);
			}
		}
	}
	/**
	 * 修改账号密码
	 */
	public function changePwd(){
		$this->hasAuthorize();
		if(empty($this->data)){	//编辑账号信息，提取资料
			$this->User->id = $this->Auth->user('id');
			$this->data = $this->User->read();
			//处理加密后的密码问题
			unset($this->data['User']['password']);		
		}
		else{	//添加新代理			
			//判断密码是否为空，为空则不修改密码。因为CakePHP的Auth组件会在这之前自动密码密码
			//字符串"7e69e1849eca3d3ef00e0eec4c712481e358b9e8"实际为“空”经过加密后结果
			if($this->data['User']['id']){	//只有在修改账号资料的时候才处理密码为空的问题
				if ($this->data['User']['password'] == '7e69e1849eca3d3ef00e0eec4c712481e358b9e8'){				
					unset($this->data['User']['password']);
				}
				unset($this->data['User']['username']);
				if($this->User->save($this->data)){
					$this->flash('密码修改成功', '/users/changePwd', 2);	
				}
				else{
					$this->flash('密码修改失败', '/users/changePwd', 2);
				}					
			}
		}
	}	
}