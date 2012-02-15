<?php
class ArticleComment extends AppModel{
	var $name = 'ArticleComment';
	
	var $belongsTo = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
			'counterCache' => true		
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
		)
	); 
}