<?php
class Member extends AppModel{
	var $name = 'Member';
	var $useTable = 'members';
	
	var $hasMany = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'user_id'
		)
	);
	
	var $hasOne = array(
		'Sina'	=> array(
			'className' 	=> 'Sina',
			'foreignKey' 	=> 'member_id',
			'dependent'		=> true
		)
	);
	
	var $hasAndBelongsToMany = array(	
		'MemberTag' => array(
			'className'		 => 'MemberTag',
			'joinTable'		 => 'members_member_tags',
			'foreignKey'	 => 'member_id',
			'associationForeignKey'	=> 'member_tag_id'
		)		
	);	
}