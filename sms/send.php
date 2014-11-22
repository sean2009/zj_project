<?php
		require_once('sms.php');

		$url = 'http://218.108.28.246:9080/OpenMasService?WSDL';
		$extendCode = "0101"; //自定义扩展代码（模块）
		$ApplicationID = "oa"; //账号
		$Password = "oapass";		//密码
		$destinationAddresses = array('13818361965');	//手机号码
		$message = 'sfsf';
		
		$paras = array(
			'destinationAddresses'	=>$destinationAddresses,
			'message'				=>$message,
			'extendCode'			=>$extendCode,
			'applicationId'			=>$ApplicationID,
			'password'				=>$Password,
			'expectSendTime'		=> 0,
		);
		$sms = new Sms($url);
		$sms->sendMessage($paras);
?>