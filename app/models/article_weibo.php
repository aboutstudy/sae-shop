<?php
class ArticleWeibo extends AppModel{
	var $name = 'ArticleWeibo';
		
	var $belongsTo = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id'
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'member_id'
		)
	);
}