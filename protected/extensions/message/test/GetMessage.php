<?php

/**
 * 功能：短信管理模块
 * 日期：2008-05-15
 * 作者：刘晨辉
 **/

header("Content-Type: text/html; charset=utf-8; xml:lang=zh-CN");

require_once('nusoap.php');
include_once('util.php');

$url = 'http://120.199.26.226:9080/openmasservice?wsdl';
	
$messageId ="40de8f6b-a85b-4e14-b52e-cd75b433a401";

$paras = array('messageId'=>$messageId);


$client = null;
$client = new nusoap_client($url,true);

$client->soap_defencoding = 'utf-8';
$client->decode_utf8 = false;
$client->xml_encoding = 'utf-8';
$err = $client->getError();
if ($err) {
	echo '<h2>连接webservice出错</h2><pre>' . $err . '</pre>';
}

$result = $client->call('GetMessage',$paras);

print_r ($result);

?>