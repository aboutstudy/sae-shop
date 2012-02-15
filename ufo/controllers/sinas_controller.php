<?php
class SinasController extends AppController{
	var $uses = array('Sina', 'Member');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Member.id' => 'DESC')
	);	
	
	public function index(){
		$list = $this->paginate('Sina');
		$this->set('list', $list);
	}
	
	public function fakerList(){
		$list = $this->paginate('Sina', array('Member.is_faker' => 1));
		$this->set('list', $list);
	}
	
	public function setWork($sina_id){
		$this->Sina->id = $sina_id;
		$this->Sina->recursive = -1;
		$sina = $this->Sina->read();
//		$requestToken = array(
//			'oauth_token' => $sina['Sina']['oauth_token'],
//			'oauth_token_searet' => $sina['Sina']['oauth_token_secret']
//		);
		$this->Session->write('Faker.sina', $sina);
		$this->flash('当前马甲账号为:'.$sina['Sina']['screen_name'], '/Iframes/rightIframe/');		
	}
	
    //账号编辑	
	public function edit($id = null){
		if(empty($this->data)){	//编辑账号信息，提取资料
			if(!empty($id)){
				$this->Sina->id = $id;
				$this->data = $this->Sina->read();
				//处理加密后的密码问题
				unset($this->data['Member']['password']);					
			}
		}
		else{	//添加新代理
			//判断密码是否为空，为空则不修改密码。因为CakePHP的Auth组件会在这之前自动密码密码
			//字符串"7ad56526211e7fc26ba54b689585db41f97d4d19"实际为“空”经过加密后结果
			$this->data['Member']['password'] = $this->Auth->password($this->data['Member']['password']);
			unset($this->data['Sina']['oauth_token']);
			unset($this->data['Sina']['oauth_token_secret']);
			if ($this->data['Member']['password'] == '7ad56526211e7fc26ba54b689585db41f97d4d19'){				
				unset($this->data['Member']['password']);
			}
				
			if($this->Member->save($this->data)){
				$this->flash('编辑成功', '/sinas/index', 2);	
			}
			else{
				$this->flash('编辑失败', '/sinas/edit', 2);
			}
		}
	}	
}