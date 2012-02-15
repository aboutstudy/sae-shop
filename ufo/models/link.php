<?php
class Link extends AppModel{
	var $name = "Link";
	var $useTable = "links";
	
	var $belongsTo = array(
		'LinkType' => array(
			'className'  => 'LinkType',
			'foreignKey' => 'type_id',
			'counterCache' => true
		)
	);
}