<?php

/**
 * 功能：短信管理模块
 * 日期：2008-05-15
 * 作者：刘晨辉
 **/

header("Content-Type: text/html; charset=utf-8");
require_once('nusoap.php');
include_once('util.php');

$url = 'http://120.199.26.226:9080/openmasservice?wsdl';
$message="<test>";
$extendCode = "13522"; //自定义扩展代码（模块）
$ApplicationID = ""; //账号
$Password = "";		//密码
$destinationAddresses = array('');	//手机号码

$paras = array(
	'destinationAddresses'	=>$destinationAddresses,
    'message'				=>$message,
    'extendCode'			=>$extendCode,
    'applicationId'			=>$ApplicationID,
    'password'				=>$Password);

$client = null;
$client = new nusoap_client($url,true);

$client->soap_defencoding = 'utf-8';
$client->decode_utf8 = false;
$client->xml_encoding = 'utf-8';
$err = $client->getError();
if ($err) {
	echo '<h2>连接webservice出错</h2><pre>' . $err . '</pre>';
}

$result = $client->call('SendMessage3', $paras);

print_r ($result);

?>