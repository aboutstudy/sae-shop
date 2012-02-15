<?php
class ArticlesCategorys extends AppModel{
	var $name = 'ArticlesCategorys';
	
	var $belongsTo = array(		
		'Article' => array(
			'className' => 'Article',
			'foreignkey' => 'article_id',
			'order' => array('Article.id' => 'DESC')			
		),
		'Category' => array(
			'className' => 'Category',
			'foreignkey' => 'category_id'
		) 
	);
}