<?php
class VideoComment extends AppModel{
	var $name = 'VideoComment';
	
	var $belongsTo = array(
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'video_id',
			'counterCache' => true		
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
		)
	); 
}