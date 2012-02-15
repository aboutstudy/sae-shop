<?php
class Section extends AppModel{
	var $name = 'Section';
	var $hasAndBelongsToMany = array(
		'Article' => array(
			'className'		 => 'Article',
			'joinTable'		 => 'articles_sections',
			'foreignKey'	 => 'section_id',
			'associationForeignKey'	=> 'article_id'
		),
		'Video' => array(
			'className'		 => 'Video',
			'joinTable'		 => 'videos_sections',
			'foreignKey'	 => 'section_id',
			'associationForeignKey'	=> 'video_id'
		)
	);
}