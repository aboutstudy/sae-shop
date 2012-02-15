<?php
class VideoWeibo extends AppModel{
	var $name = 'VideoWeibo';
		
	var $belongsTo = array(
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'video_id'
		)
	);
}