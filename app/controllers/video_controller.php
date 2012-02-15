<?php
class VideoController extends AppController{
	var $uses = array('Video', 'Tag', 'Category', 'VideoWeibo', 'VideoComment', 'VideosTags');
	var $paginate = array(
		'conditions' => array('Video.status' => 1),
		'order' => array('Video.updated' => 'DESC'),
		'limit' => 25	
	);
		
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	
	public function index(){
		
	}
	
	/**
	 * 视频详细页
	 * @param unknown_type $id
	 */
	public function view($id){
		$this->Video->id = $id;
		$this->data = $this->Video->read();
		
		//获取内容标签数组
		$arrTag = array();
		$arrTagForMore = array();
		foreach($this->data['Tag'] as $tag){
			$arrTag[] = $tag['id'];
			$arrTagForMore[]['Tag'] = array('id' => $tag['id'], 'title' => $tag['title']);
		}
		//获取最多3个标签
		$arrTagForMore = array_slice($arrTagForMore, 0, 3);
		//根据关联标签获取相关视频
		$relationVideo = $this->VideosTags->find('all', array('conditions' => array('Tag.id' => $arrTag, 'Video.status' => 1, 'Video.id <>' => $id), 'group' => array('Video.id'), 'limit' => 4));
//		print_r($relationVideo);
		//按标签关联视频不足时取最新视频补充
		if (count($relationVideo) < 4){
			$hasVideoID = array();
			foreach($relationVideo as $video){
				$hasVideoID[] = $video['Video']['id']; 
			}
			$this->Video->recursive = -1;
			$tmpVideo = $this->Video->find('all', array('conditions' => array('NOT' => array('Video.id' => $hasVideoID), 'Video.status' => 1, 'Video.id <>' => $id), 'group' => array('Video.id'), 'order' => array('Video.updated' => 'DESC'), 'limit' => (4 - count($relationVideo))));
//			$relationVideo = array_merge($relationVideo, $tmpVideo);
		}
//		print_r($tmpVideo);exit;
		$this->set('relationVideo', $relationVideo);
		$this->set('arrTagForMore', $arrTagForMore);
		
		//第1页评论采用缓存，评论翻页结果直接读取数据库
		$commentList = Cache::read('COMMENT_VIDEO_'.$id);
//		if($commentList === false){
		if(1){
			$this->VideoComment->recursive = 1;
			$this->paginate['order'] = array('VideoComment.created' => 'DESC');
			$commentList = $this->paginate('VideoComment', array('VideoComment.video_id' => $id));
			Cache::write('COMMENT_VIDEO_'.$id, $commentList);			
		}		
//		print_r($commentList);exit;
		$this->set('commentList', $commentList);		
				
		$this->set('title_for_layout', $this->data['Video']['title']);
	}
	
	/**
	 * 视频分类、标签搜索结果
	 */
	public function search(){		
		//SEO 关键词
		$keyword_for_head = '';
		
		if(isset($this->params['named']['tag'])){
			$list = $this->paginate('VideosTags', array('Tag.title' => $this->params['named']['tag']));
			$this->set('keyword', $this->params['named']['tag']);
			$keyword_for_head = $this->params['named']['tag'];
		}
		else if(isset($this->params['named']['category'])){
			$list = $this->paginate('VideosCategorys', array('Category.title' => $this->params['named']['category']));
			$this->set('keyword', $this->params['named']['category']);
			$keyword_for_head = $this->params['named']['category'];
		}
		else{
			$this->Video->recursive = 0;
			$list = $this->paginate('Video');
			$this->set('keyword', '全部');
		}		
		$this->set('list', $list);
		$this->set('title_for_layout', ' 视频课堂 ' . $keyword_for_head);
	}	
}