<?php
class LinkType extends AppModel{
	var $name = 'LinkType';
	var $useTable = 'link_types';
	
	var $hasMany = array(
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'type_id',
			'order' => 'Link.id DESC'
		)
	);
}