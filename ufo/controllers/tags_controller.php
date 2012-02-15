<?php
class TagsController extends AppController{
	var $uses = array('Tag');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Tag.id' => 'DESC')
	);
	
	public function index(){
		$arrTags = $this->paginate('Tag');
		$this->set('arrTags', $arrTags);		
	}
	
	/*
	 * 添加、编辑标签
	 */
	public function edit($tag_id = null){
		if(empty($this->data)){
			if(isset($tag_id)){
				$this->Tag->id = $tag_id;
				$this->Tag->recursive = -1;
				$this->data = $this->Tag->read();
			}
		}
		else{
			$hasOne = $this->Tag->findByTitle($this->data['Tag']['title']);
//			print_r($hasOne);exit;
			if(!empty($hasOne['Tag']) AND empty($this->data['Tag']['id'])){
				$this->flash('已经存在标签：'.$this->data['Tag']['title'],'/tags/index');
			}
			elseif(!empty($hasOne['Tag']) AND $this->data['Tag']['id'] <> $hasOne['Tag']['id']){
				$this->flash('已经存在标签：'.$this->data['Tag']['title'],'/tags/index');
			}
			elseif($this->Tag->save($this->data)){
				$this->flash('成功编辑标签','/tags/index');
			}
			else{
				$this->flash('编辑标签失败！', '/tags/index');
			}
		}
	}
}