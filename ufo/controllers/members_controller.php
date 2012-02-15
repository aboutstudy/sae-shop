<?php
class MembersController extends AppController{
	var $uses = array('Sina', 'Member', 'MemberTag');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Member.id' => 'DESC')
	);	
	
	public function index(){
		$list = $this->paginate('Member');
		$this->set('list', $list);
	}
	
	public function fakerList(){
		$list = $this->paginate('Sina', array('Member.is_faker'));
		$this->set('list', $list);
	}
	
    //账号编辑	
	public function edit($id = null){
		if(empty($this->data)){	//编辑账号信息，提取资料
			if(!empty($id)){
				$this->Member->id = $id;
				$this->data = $this->Member->read();
//				print_r();exit;
				//处理加密后的密码问题
				unset($this->data['Member']['password']);					
			}
			
			//获取会员分类标签（网站配置、后台管理级别）
			$arrMemberTags = $this->MemberTag->find('list', array('conditions' => array('MemberTag.type >=' => 4)));
			$this->set('arrMemberTags', $arrMemberTags);
		}
		else{	//添加账号			
//			print_r($this->data);exit;
//			$this->data['MemberTag']['MemberTag'] = array(1, 2);
			//判断密码是否为空，为空则不修改密码。因为CakePHP的Auth组件会在这之前自动密码密码
			//字符串"7ad56526211e7fc26ba54b689585db41f97d4d19"实际为“空”经过加密后结果
			$this->data['Member']['password'] = $this->Auth->password($this->data['Member']['password']);
			if ($this->data['Member']['password'] == '7ad56526211e7fc26ba54b689585db41f97d4d19'){				
				unset($this->data['Member']['password']);
			}
				
			if($this->Member->save($this->data)){
				$this->flash('编辑成功', '/members/index', 2);	
			}
			else{
				$this->flash('编辑失败', '/members/edit/'.$id, 2);
			}
		}
	}	
	
	public function delete($id){
		if($this->Member->delete($id)){
			$this->flash('成功删除会员', '/Members/index/', 2);
		}
		else{
			$this->flash('删除会员失败', '/Members/index/', 2);
		}
	}
}