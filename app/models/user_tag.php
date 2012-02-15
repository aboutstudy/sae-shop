<?php
class UserTag extends AppModel{
	var $name = 'UserTag';
	var $useTable = 'member_tags';
	
	var $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'members_member_tags',
			'foreignKey' => 'member_tag_id',
			'associationForeignKey' => 'member_id',
			'order' => array('MembersMemberTag.id' => 'DESC'),
			'limit' => 10
		)
	);
}