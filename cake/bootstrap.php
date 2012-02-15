<?php
/**
 * Basic Cake functionality.
 *
 * Handles loading of core files needed on every request
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if (!defined('PHP5')) {
	define('PHP5', (PHP_VERSION >= 5));
}
if (!defined('E_DEPRECATED')) {
	define('E_DEPRECATED', 8192);
}
error_reporting(E_ALL & ~E_DEPRECATED);

require CORE_PATH . 'cake' . DS . 'basics.php';
$TIME_START = getMicrotime();
require CORE_PATH . 'cake' . DS . 'config' . DS . 'paths.php';
require LIBS . 'object.php';
require LIBS . 'inflector.php';
require LIBS . 'configure.php';
require LIBS . 'set.php';
require LIBS . 'cache.php';
Configure::getInstance();
require CAKE . 'dispatcher.php';

//新浪微博SDK配置文件
//define( "WB_AKEY" , '2349958006' );
//define( "WB_SKEY" , 'e863e6b596e2d7a1e7c0c9440f6869ec' );
define( "WB_AKEY" , '728177611' );
define( "WB_SKEY" , '384e3be40263db98bafdb8746e886f00' );

/**
 * 通用函数定义
 */ 
function _cURL($URL, $params = null, $is_POST = 0){	
	$con = curl_init();
	curl_setopt($con, CURLOPT_URL, $URL);
	curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
	
	if($is_POST == 1){
		curl_setopt($con, CURLOPT_POST, 1);
		curl_setopt($con, CURLOPT_POSTFIELDS, $params);			
	}
	
	$output = curl_exec($con);
	curl_close($con);							

	return $output;
}