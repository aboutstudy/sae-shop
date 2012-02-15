<?php
class Tag extends AppModel{
	var $name = 'Tag';
	var $hasAndBelongsToMany = array(
		'Article' => array(
			'className'		 => 'Article',
			'joinTable'		 => 'articles_tags',
			'foreignKey'	 => 'tag_id',
			'associationForeignKey'	=> 'article_id', 
			'order' => array('Article.id' => 'DESC'),
			'limit'	=> 10	
		),
		'Video' => array(
			'className'		 => 'Video',
			'joinTable'		 => 'videos_categorys',
			'foreignKey'	 => 'category_id',
			'associationForeignKey'	=> 'video_id', 
			'order'	=> array('Video.id' => 'DESC'),
			'limit'	=> 10		
		)
	);
}