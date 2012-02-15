<?php
class ArticleComment extends AppModel{
	var $name = 'ArticleComment';
	
	var $belongsTo = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
			'counterCache' => true		
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'member_id',
		)
	); 
}