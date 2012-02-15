<?php
class ArticlesTags extends AppModel{
	var $name = 'ArticlesTags';
	
	var $belongsTo = array(		
		'Article' => array(
			'className' => 'Article',
			'foreignkey' => 'article_id',
			'order' => array('Article.id' => 'DESC')			
		),
		'Tag' => array(
			'className' => 'Tag',
			'foreignkey' => 'tag_id'
		) 
	);
}