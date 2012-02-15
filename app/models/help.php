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
	
	/**
	 * 获取帮助列表(排除当前)
	 * @param unknown_type $help_type	分类ID
	 * @param unknown_type $id			当前帮助ID
	 * @param unknown_type $home_id		分类首页ID
	 * @param unknown_type $limit		分类数量
	 */
	public function getOthers($help_type, $limit = null, $id = 0, $home_id = 1){
		$list = $this->find('all', array('conditions' => array('Help.help_type_id' => $help_type, 'NOT' => array('Help.id' => array($id, $home_id))), 'limit' => $limit));
		return $list;		
	}
}