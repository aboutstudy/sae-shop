<?php
class MemberTag extends AppModel{
	var $name = 'MemberTag';
	var $useTable = 'member_tags';
	
	var $hasAndBelongsToMany = array(
		'Member' => array(
			'className' => 'Member',
			'joinTable' => 'members_member_tags',
			'foreignKey' => 'member_tag_id',
			'associationForeignKey' => 'member_id'
		)
	);
}