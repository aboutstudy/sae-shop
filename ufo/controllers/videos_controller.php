<?php
class VideosController extends AppController{
	var $uses = array('Video', 'Tag');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Video.id' => 'DESC', 'Video.updated DESC')
	);
	
	public function index($status = NULL){
		$this->Video->recursive = -1;
		if (is_null($status)){
			$arrList = $this->paginate('Video');
		}
		else{
			$arrList = $this->paginate('Video', array('Video.status' => $status));	
		}
				
		$this->set('arrList', $arrList);

		$faker = $this->Session->read('Faker.sina');
		if(empty($faker)){
			$this->flash('未设置操作马甲账号，请先设置', '/sinas/fakerList');
		}
		else{
			$this->set('Faker', $faker);	
		}
	}
	
	/*
	 * 添加、编辑内容
	 */
	public function edit($video_id = null){
		if(empty($this->data)){
			if(isset($video_id)){
				$this->Video->id = $video_id;
				$this->Video->recursive = 1;
				$this->data = $this->Video->read();
				$this->data['Video']['strTags'] = '';
				foreach ($this->data['Tag'] as $tag){
					$this->data['Video']['strTags'] .= $tag['title'] . ' '; 
				}				
			}
//			$tags = $this->Video->Tag->find('list');
//			$this->set('tags', $tags);

			$categorys = $this->Video->Category->find('list');
			$sections = $this->Video->Section->find('list', array('conditions' => array('Section.type' => 2)));
			
			$this->set('categorys', $categorys);
			$this->set('sections', $sections);
//			print_r($this->data);exit;			
		}
		else{
//			print_r($this->data);exit;
//			$this->data['Category']['id'] = 3;
//			$this->data['Tag']['id'] = 3;
			$this->data['Tag']['Tag'] = $this->Tag->checkAdd($this->data['Video']['strTags']);
			if($this->Video->saveAll($this->data)){
				$this->flash('成功编辑视频','/videos/index');
			}
			else{
				$this->flash('编辑视频失败！', '/videos/index');
			}
		}
	}
	
	public function view($id){
		$this->redirect('http://'.$_SERVER['HTTP_HOST'].'/video/view/' . $id);
	}	
	
	public function delete($id){
		if($this->Video->delete($id)){
			$this->flash('删除成功', '/videos/index/0');
		}
		else{
			$this->flash('删除失败', '/videos/index/0');
		}
	}	
}