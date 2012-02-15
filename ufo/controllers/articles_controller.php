<?php
class ArticlesController extends AppController{
	var $uses = array('Article', 'Tag');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $paginate = array(
		'limit' => 20,
		'order' => array('Article.id' => 'DESC', 'Article.updated DESC')
	);
	
	public function index($status = NULL){		
		if (is_null($status)){
			$arrArticles = $this->paginate('Article');
		}
		else{
			$arrArticles = $this->paginate('Article', array('Article.status' => $status));	
		}
		$this->set('arrArticles', $arrArticles);
				
		$faker = $this->Session->read('Faker.sina');
		if(empty($faker)){
			$this->flash('未设置操作马甲账号，请先设置', '/sinas/fakerList');
		}
		else{
			$this->set('Faker', $faker);	
		}
	}
	
	/*
	 * 添加、编辑文章
	 */
	public function edit($article_id = null){
		if(empty($this->data)){
			if(isset($article_id)){
				$this->Article->id = $article_id;
				$this->Article->recursive = 1;
				$this->data = $this->Article->read();
				
				$this->data['Article']['strTags'] = '';
				foreach ($this->data['Tag'] as $tag){
					$this->data['Article']['strTags'] .= $tag['title'] . ' '; 
				}
			}
						
			//预处理数据
			$tags = $this->Article->Tag->find('list');
			$categorys = $this->Article->Category->find('list');
			$sections = $this->Article->Section->find('list', array('conditions' => array('Section.type' => 1)));
			$this->set('tags', $tags);
			$this->set('categorys', $categorys);
			$this->set('sections', $sections);
//			print_r($this->data);exit;			
		}
		else{
//			print_r($this->data);exit;
			$this->data['Tag']['Tag'] = $this->Tag->checkAdd($this->data['Article']['strTags']);
			if($this->Article->saveAll($this->data)){
				$this->flash('成功编辑文章','/articles/index');
			}
			else{
				$this->flash('编辑文章失败！', '/articles/index');
			}
		}
	}
	
	public function view($id){
		$this->redirect('http://'.$_SERVER['HTTP_HOST'].'/baike/view/' . $id);
	}
	
	public function delete($id){
		if($this->Article->delete($id)){
			$this->flash('删除成功', '/articles/index/0');
		}
		else{
			$this->flash('删除失败', '/articles/index/0');
		}
	}
}