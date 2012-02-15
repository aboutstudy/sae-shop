<?php
class ArticleWeibo extends AppModel{
	var $name = 'ArticleWeibo';
		
	var $belongsTo = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id'
		)
	);
}