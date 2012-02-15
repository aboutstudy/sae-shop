<?php
class Sina extends AppModel{
	var $name = 'Sina';
	
	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id'
		)
	);
}