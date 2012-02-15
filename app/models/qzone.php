<?php
class Qzone extends AppModel{
	var $name = 'Qzone';

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignkey' => 'member_id'	
		)
	);
	
	public function getConfig(){
		$config = array();
		$config['appid'] 	= 202215;
		$config['appkey'] 	= '17aaad2be3c7166a2d0fdaabc9058221';
		$config['callback'] = 'http://www.doucl.com/Users/qzoneResponse';
		return $config;
	}	
}