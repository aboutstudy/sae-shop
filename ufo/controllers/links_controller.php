<?php
class LinksController extends AppController{
	var $uses = array('Link', 'LinkType');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Link.id' => 'DESC')
	);
	
	/**
	 * 分类的分类
	 * @param $link_type_type
	 */
	public function index($link_type_type = null){
		if(!empty($link_type_type)){
			$this->set('link_type_type', $link_type_type);
		}		
		$list = $this->paginate('Link');
		$this->set('list', $list);
	}
	
	/**
	 * 编辑链接
	 * @param $id		链接ID
	 * @param $type		分类的type:1-商城广告位, 2-网站广告位,3-友情链接
	 */
	public function edit($id = null, $type = null){
		if(empty($type)){
			$linkTypes = $this->LinkType->find('list');
			$this->set('linkTypes', $linkTypes);
		}
		else{
			$linkTypes = $this->LinkType->find('list', array('conditions' => array('LinkType.type' => $type)));
			$this->set('linkTypes', $linkTypes);			
		}
		
		if(empty($this->data)){
			if(isset($id)){
				$this->Link->id = $id;
				$this->Link->recursive = -1;
				$this->data = $this->Link->read();
			}
		}
		else{
			if($this->Link->save($this->data)){
				$this->flash('成功编辑链接','/Links/index');
			}
			else{
				$this->flash('编辑链接失败！', '/Links/index');
			}
		}
	}
}