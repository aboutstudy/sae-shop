<?php
class VideosTags extends AppModel{
	var $name = 'VideosTags';
	
	var $belongsTo = array(		
		'Video' => array(
			'className' => 'Video',
			'foreignkey' => 'video_id',
			'order' => array('Video.id' => 'DESC')			
		),
		'Tag' => array(
			'className' => 'Tag',
			'foreignkey' => 'tag_id'
		) 
	);
}