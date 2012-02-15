<?php
class Video extends AppModel{
	var $name = 'Video';
	
	var $hasOne = array(
		'VideoDesc' => array(
			'className' 	 => 'VideoDesc',
			'foreignKey'	 => 'video_id',
			'dependent' 	 => true 
		),
		'VideoWeibo' => array(
			'className' 	 => 'VideoWeibo',
			'foreignKey'	 => 'video_id',
			'dependent' 	 => true 
		)	
	);
	
	var $hasAndBelongsToMany = array(
		'Tag' => array(
			'className'		 => 'Tag',
			'joinTable'		 => 'videos_tags',
			'foreignKey'	 => 'video_id',
			'associationForeignKey'	=> 'tag_id'
		),
		'Category' => array(
			'className'		 => 'Category',
			'joinTable' 	 => 'videos_categorys',
			'foreignKey' 	 => 'video_id',
			'associationForeignKey'	=> 'category_id'
		),
		'Section' => array(
			'className'		 => 'Section',
			'joinTable' 	 => 'videos_sections',
			'foreignKey' 	 => 'video_id',
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