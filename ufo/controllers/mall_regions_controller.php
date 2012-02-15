<?php
class MallRegionsController extends AppController{
	var $uses = array('MallRegion');
	var $paginate = array(
		'limit' => 20,
		'order' => array('MallRegion.id' => 'ASC')
	);	
	
	public function index($parent_id = 0){
		$list = $this->paginate('MallRegion', array('parent_id' => $parent_id));
		$this->set('list', $list);
		$this->data = $this->MallRegion->findById($parent_id);
		if(empty($this->data)){
			$this->set('editURL', '/MallRegions/edit/null/0/1/');
		}
		else{
			$this->set('editURL', '/MallRegions/edit/null/'.$this->data['MallRegion']['id'].'/'.($this->data['MallRegion']['region_type'] + 1));	
		}
	}
	
	/*
	 * 添加、编辑
	 */
	public function edit($id = null, $parent_id = null, $region_type = null){
		if(empty($this->data)){
			if(isset($id)){
				$this->MallRegion->id = $id;
				$this->MallRegion->recursive = -1;
				$this->data = $this->MallRegion->read();
			}
			
			if(isset($parent_id)){
				$this->data['MallRegion']['parent_id'] = $parent_id;
			}
			
			if (isset($region_type)){
				$this->data['MallRegion']['region_type'] = $region_type;
			}
		}
		else{
			if($this->MallRegion->save($this->data)){
				$this->flash('成功编辑地区','/MallRegions/index');
			}
			else{
				$this->flash('编辑地区失败！', '/MallRegions/index');
			}
		}
	}
}