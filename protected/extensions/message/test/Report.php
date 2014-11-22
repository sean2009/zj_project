<?php

/**
 * 功能：接受回执
 * 日期：20120423
 * 作者：刘小波
 **/
ini_set('display_errors','on');
require_once('nusoap.php');


function cdrUpdate_log($data, $flag_alert)
{
	$write_line	= "";
	$now	= date('Y-m-d H:i:s',time());
	if(strlen($data)>0) {
		if($flag_alert)
			$write_line	= "!" . mysql_error();
		$write_line	.= "[" . date('Y-m-d H:i:s',time()) . "]" . $data;
	}
	$dir		= "/tmp/sendSms_log/";
	if(!is_dir($dir)) {
		mkdir($dir, 0777);
	}
	$filename	= date('Y-m',time());
	$filename	= $dir.$filename.".txt";
	if (false==file_exists($filename)){
		if($fp = fopen("$filename", 'w')) {
			fwrite($fp, "\n//JUST-CALL! log file, DO NOT modify me!\n".
				"//Created on ".date("M j, Y, G:i")."\n");
			fclose($fp);
		}

	}
	if($fp = fopen("$filename",'a')) {
		fwrite($fp,"$write_line\n");
		fclose($fp);
	}
}



function NotifySmsDeliveryReport($receivedAddress) {
	$date = '';
	foreach($receivedAddress as $key => $value){
		$date .= "$key : $value ,";
		$result[$key] = $value;
	}
  cdrUpdate_log( $date,$date);

  /*

  if($result['statusCode'] == 'DELIVRD'){
	  $send_status = 1;
  }else{
	  $send_status = 2;
  }
	
 $sms_sql = "update sms_send SET send_status = '".$send_status."' where token = '".$result['messageId']."'";

 */

  return $messageId;
}



$soap = new soap_server;
//短信回执
$soap->configureWSDL('Report');
$soap->register('NotifySmsDeliveryReport',
	array('receivedAddress'	=>'xsd:string'),
	array("return" => "xsd:string") //输入
	);

$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:""; 
$soap->service($HTTP_RAW_POST_DATA);


?>