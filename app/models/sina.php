<?php
class Sina extends AppModel{
	var $name = 'Sina';
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignkey' => 'member_id'	
		)
	);
}