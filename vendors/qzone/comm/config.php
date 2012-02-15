<?php
/**
 * PHP SDK for QQ登录 OpenAPI
 *
 * @version 1.3
 * @author connect@qq.com
 * @copyright © 2011, Tencent Corporation. All rights reserved.
 */

/**
 * @brief 本文件作为demo的配置文件。
 */

/**
 * 正式运营环境请关闭错误信息
 * ini_set("error_reporting", E_ALL);
 * ini_set("display_errors", TRUE);
 * QQDEBUG = true  开启错误提示
 * QQDEBUG = false 禁止错误提示
 * 默认禁止错误信息
 */
define("QQDEBUG", true);
if (defined("QQDEBUG") && QQDEBUG)
{
    @ini_set("error_reporting", E_ALL);
    @ini_set("display_errors", TRUE);
}

/**
 * session
 */
include_once("session.php");


/**
 * 在你运行本demo之前请到 http://connect.opensns.qq.com/申请appid, appkey, 并注册callback地址
 */
//申请到的appid
$_SESSION["appid"]    = 202215; 
//$_SESSION["appid"]    = 222222;
 

//申请到的appkey
$_SESSION["appkey"]   = "17aaad2be3c7166a2d0fdaabc9058221"; 
//$_SESSION["appkey"]   = "005831692a444765a0db25a4a5ac052c"; 

//QQ登录成功后跳转的地址,请确保地址真实可用，否则会导致登录失败。
//$_SESSION["callback"] = "http://www.doucl.com/Users/bondQzone";
$_SESSION["callback"] = "http://www.doucl.com/files/qq/oauth/get_access_token.php";
 
//$_SESSION["callback"] = "http://www.goodsite.com/php/oauth/get_access_token.php"; 

//print_r ($_SESSION);
?>
