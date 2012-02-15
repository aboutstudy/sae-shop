<?php
class Category extends AppModel{
	var $name = 'Category';
	var $useTable = 'categorys';
	var $hasAndBelongsToMany = array(
		'Article' => array(
			'className'		 => 'Article',
			'joinTable'		 => 'articles_categorys',
			'foreignKey'	 => 'category_id',
			'associationForeignKey'	=> 'article_id',
			'conditions' => array('Article.status' => 1)
		),
		'Video' => array(
			'className'		 => 'Video',
			'joinTable'		 => 'videos_categorys',
			'foreignKey'	 => 'category_id',
			'associationForeignKey'	=> 'video_id' 
		)
	);
}