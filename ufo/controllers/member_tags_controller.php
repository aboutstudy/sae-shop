<?php
class MemberTagsController extends AppController{
	var $uses = array('MemberTag');
	var $paginate = array(
		'order' => array('MemberTag.id' => 'DESC'),
		'limit' => 20
	);
	
	public function index(){
		$list = $this->paginate('MemberTag');
		$this->set('list', $list);
	}
	
	/*
	 * 添加、编辑标签
	 */
	public function edit($tag_id = null){
		if(empty($this->data)){
			if(isset($tag_id)){
				$this->MemberTag->id = $tag_id;
				$this->MemberTag->recursive = -1;
				$this->data = $this->MemberTag->read();
			}
		}
		else{
//			print_r($this->data);exit;
			$hasOne = $this->MemberTag->findByTitle($this->data['MemberTag']['title']);
			if(!empty($hasOne['MemberTag']) AND empty($this->data['MemberTag']['id'])){
				$this->flash('已经存在标签：'.$this->data['MemberTag']['title'],'/MemberTags/index');
			}
			elseif(!empty($hasOne['MemberTag']) AND $this->data['MemberTag']['id'] <> $hasOne['MemberTag']['id']){
				$this->flash('已经存在标签：'.$this->data['MemberTag']['title'],'/MemberTags/index');
			}
			elseif($this->MemberTag->save($this->data)){
				$this->flash('成功编辑标签','/MemberTags/index');
			}
			else{
				$this->flash('编辑标签失败！', '/MemberTags/index');
			}
		}
	}
}