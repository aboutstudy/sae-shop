<?php
class Help extends AppModel{
	var $name = 'Help';
	var $tableName = 'helps';
	
	var $belongsTo = array(
		'HelpType' => array(
			'class' => 'HelpType',
			'foreignKey' => 'help_type_id',
			'counterCache' => true	
		)
	);
}