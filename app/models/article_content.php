<?php
class ArticleContent extends AppModel{
	var $name = 'ArticleContent';
	var $belongsTo = array(
		'Article' => array(
			'className'		 => 'Article',
			'foreignKey'	 => 'article_id',
			'counterCache' 	 => true
		)
	);
}