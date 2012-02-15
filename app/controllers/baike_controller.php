<?php
class BaikeController extends AppController{
	var $uses = array('Article', 'Tag', 'Category', 'ArticleWeibo', 'ArticleComment', 'ArticlesTags', 'Video', 'VideosTags');
	var $paginate = array(
		'limit' => 12,
		'conditions' => array('Article.status' => 1),
		'order' => array('Article.updated' => 'DESC')
	);	
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	
	/**
	 * 栏目首页
	 */
	public function index(){
		
	}
	
	/**
	 * 查看百科详细
	 * @param unknown_type $id
	 */
	public function view($id){
		$this->Article->id = $id;
		$this->data = $this->Article->read();
				
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
		$relationVideo = $this->VideosTags->find('all', array('conditions' => array('Tag.id' => $arrTag, 'Video.status' => 1), 'group' => array('Video.id'), 'limit' => 4));

		//按标签关联视频不足时取最新视频补充
		if (count($relationVideo) < 4){
			$hasVideoID = array();
			foreach($relationVideo as $video){
				$hasVideoID[] = $video['Video']['id']; 
			}
			$this->Video->recursive = -1;
			$tmpVideo = $this->Video->find('all', array('conditions' => array('NOT' => array('Video.id' => $hasVideoID), 'Video.status' => 1), 'group' => array('Video.id'), 'order' => array('Video.updated' => 'DESC'), 'limit' => (4 - count($relationVideo))));
			$relationVideo = array_merge($relationVideo, $tmpVideo);
		}
		$this->set('relationVideo', $relationVideo);
		$this->set('arrTagForMore', $arrTagForMore);

		//第1页评论采用缓存，评论翻页结果直接读取数据库
		//$commentList = Cache::read('COMMENT_BK_'.$id);
//		if($commentList === false){
		if(1){
			$this->ArticleComment->recursive = 0;
			$this->paginate['limit'] = 15;
			$this->paginate['order'] = array('ArticleComment.created' => 'DESC');
			$commentList = $this->paginate('ArticleComment', array('ArticleComment.article_id' => $id));
			//Cache::write('COMMENT_BK_'.$id, $commentList);			
		}		
		$this->set('commentList', $commentList);
				
		$this->set('title_for_layout', $this->data['Article']['title']);
	}
	
	/**
	 * 分类、标签搜索结果
	 */
	public function search(){	
//		$this->paginate = array('group' => array('Article.id'));	
			
		//SEO 关键词
		$keyword_for_head = '';				
		if(isset($this->params['named']['tag'])){
			$list = $this->paginate('ArticlesTags', array('Tag.title' => $this->params['named']['tag']));
			foreach($list as $num => $item){
				$article_weibo = $this->ArticleWeibo->findByArticleId($item['Article']['id']);
				$list[$num]['ArticleWeibo'] = $article_weibo['ArticleWeibo'];
				$list[$num]['User'] = $article_weibo['User'];
				unset($article_weibo);
			}
			$this->set('keyword', $this->params['named']['tag']);
			$keyword_for_head = $this->params['named']['tag'];
		}
		else if(isset($this->params['named']['category'])){
			$list = $this->paginate('ArticlesCategorys', array('Category.title' => $this->params['named']['category']));
			
			foreach($list as $num => $item){
				$article_weibo = $this->ArticleWeibo->findByArticleId($item['Article']['id']);
				$list[$num]['ArticleWeibo'] = $article_weibo['ArticleWeibo'];
				$list[$num]['User'] = $article_weibo['User'];
				unset($article_weibo);
			}			
			$this->set('keyword', $this->params['named']['category']);
			$keyword_for_head = $this->params['named']['category'];
		}
		else{
			$this->Article->recursive = 0;
			$list = $this->paginate('Article');
			$this->set('keyword', '全部');
		}		
		
		//获取总视频数
		$baikeCount = $this->Article->find('count');
		$this->set('baikeCount', $baikeCount);
				
		$this->set('list', $list);
		$this->set('title_for_layout', '美丽百科 ' . $keyword_for_head);
	}
}