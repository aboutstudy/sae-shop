<?php
class HelpType extends AppModel{
	var $name = 'HelpType';
	var $tableName = 'help_types';
	
	var $hasMany = array(
		'Help' => array(
			'class' => 'Help',
			'foreignKey' => 'help_type_id',
			'dependent' => true	
		)
	);
}