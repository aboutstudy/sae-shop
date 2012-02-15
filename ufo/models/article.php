<?php
class Article extends AppModel{
	var $name = 'Article';
	var $hasMany = array(
		'ArticleContent' => array(
			'className' 	=> 'ArticleContent',
			'foreignKey' 	=> 'article_id',
			'order'			=> 'ArticleContent.id ASC',
			'counterCache' 	=> true,
			'dependent'		=> true 
		)
	);
	
	var $hasOne = array(
		'ArticleWeibo' => array(
			'className' 	 => 'ArticleWeibo',
			'foreignKey'	 => 'article_id',
			'dependent' 	 => true 
		)
	);
	
	var $hasAndBelongsToMany = array(
		'Tag' => array(
			'className'		 => 'Tag',
			'joinTable'		 => 'articles_tags',
			'foreignKey'	 => 'article_id',
			'associationForeignKey'	=> 'tag_id'
		),
		'Category' => array(
			'className'		 => 'Category',
			'joinTable' 	 => 'articles_categorys',
			'foreignKey' 	 => 'article_id',
			'associationForeignKey'	=> 'category_id'
		),
		'Section' => array(
			'className'		 => 'Section',
			'joinTable' 	 => 'articles_sections',
			'foreignKey' 	 => 'article_id',
			'associationForeignKey'	=> 'section_id'
		) 
	);	
	var $belongsTo = array(
		'Member' => array(
			'className' 	 => 'Member',
			'foreignKey' 	 => 'member_id'
		),
		'User'	 => array(
			'className' 	 => 'User',
			'foreignKey' 	 => 'user_id'
		)
	);
}