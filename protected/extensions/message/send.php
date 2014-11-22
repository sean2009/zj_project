<?php
		require_once('nusoap.php');
		//include_once('util.php');

		$url = 'http://218.108.28.246:9080/OpenMasService';
		$extendCode = "0101"; //自定义扩展代码（模块）
		$ApplicationID = "oa"; //账号
		$Password = "oapass";		//密码
		$destinationAddresses = array($mobile);	//手机号码

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
			$this->addError('send','连接出错');
			echo '连接出错';
			return false;
			//echo '<h2>连接webservice出错</h2><pre>' . $err . '</pre>';
		}

		$result = $client->call('SendMessage3', $paras);
		//return true;
		print_r ($result);
?>