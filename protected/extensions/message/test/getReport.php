<?php

/**
 * 功能：短信管理模块
 * 日期：2008-05-15
 * 作者：刘晨辉
 **/

//header("Content-Type: text/html; charset=utf-8");
ini_set('display_errors','on');
require_once('nusoap.php');

$client = new soapclient('http://119.8.187.50:6158/webservice/Report.php'); 


$parg = array(
		'messageDeliveryStatus'		=> '22',
		'messageId'					=> '55231',
		'receivedAddress'			=> '13760479200',
		'sendAddress'				=> '13800138000',
		'statusCode'				=> 'DELIVRD'
	);
$str=$client->call('NotifySmsDeliveryReport',$parg); 

print_r($str);

//如果没有错误， getError() 方法返回 false ；如果有错误， getError()方法返回错误信息。


if (!$err=$client->getError()) {
    echo ' 程序返回 :',htmlentities($str,ENT_QUOTES);
} else {
    echo ' 错误 :',htmlentities($err,ENT_QUOTES);
}

?>