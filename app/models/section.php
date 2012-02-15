<?php
class Section extends AppModel{
	var $name = 'Section';
	var $hasAndBelongsToMany = array(
		'Article' => array(
			'className'		 => 'Article',
			'joinTable'		 => 'articles_sections',
			'foreignKey'	 => 'section_id',
			'associationForeignKey'	=> 'article_id',
			'conditions' => array('Article.status' => 1),
			'order' => 'Article.updated DESC', 
			'limit'	=> 10
		),
		'Video' => array(
			'className'		 => 'Video',
			'joinTable'		 => 'videos_sections',
			'foreignKey'	 => 'section_id',
			'associationForeignKey'	=> 'video_id',
			'conditions' => array('Video.status' => 1), 
			'order' => 'Video.updated DESC',
			'limit'	=> 10
		)
	);
}