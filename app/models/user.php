<?php
class User extends AppModel{
	var $name = 'User';
	var $useTable = 'members';
	
	var $hasOne = array(
		'Sina' => array(
			'className' => 'Sina',
			'foreignKey' => 'member_id'
		),
		'Qzone' => array(
			'className' => 'Qzone',
			'foreignKey' => 'member_id'
		)
	);
	
	var $hasMany = array(
		'ArticleWeibo' => array(
			'className' => 'ArticleWeibo',
			'foreignKey' => 'member_id'
		)
	);
	var $hasAndBelongsToMany = array(	
		'UserTag' => array(
			'className'		 => 'UserTag',
			'joinTable'		 => 'members_member_tags',
			'foreignKey'	 => 'member_id',
			'associationForeignKey'	=> 'member_tag_id'
		)		
	);	
}