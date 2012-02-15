<?php
class VideosCategorys extends AppModel{
	var $name = 'VideosCategorys';
	
	var $belongsTo = array(		
		'Video' => array(
			'className' => 'Video',
			'foreignkey' => 'video_id',
			'order' => array('Video.id' => 'DESC')			
		),
		'Category' => array(
			'className' => 'Category',
			'foreignkey' => 'category_id'
		) 
	);
}