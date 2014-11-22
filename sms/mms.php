<?php
/*
 *	$Id: wsdlclient10.php,v 1.2 2007/04/13 14:22:09 snichol Exp $
 *
 *	WSDL client sample.
 *	Demonstrates de-serialization of a document/literal array (added nusoap.php 1.73).
 *
 *	Service: WSDL
 *	Payload: document/literal
 *	Transport: http
 *	Authentication: none
 */
header("Content-Type: text/html; charset=utf-8");
require_once('nusoap.php');

class Mms{
	private $client;
	private $err;
	function __construct($url) 
    { 
		$this->client = new nusoap_client($url,true);
		$this->client->soap_defencoding = 'utf-8';
		$this->client->decode_utf8 = false;
		$this->client->xml_encoding = 'utf-8';
		$err = $this->client->getError();
		if ($err) {
			echo '<h2>连接webservice出错</h2><pre>' . $err . '</pre>';
		}
    }
   /*
	*	发送彩信
	*	$paras = array('destinationAddresses'=>$destinationAddresses,
	*				 'subject'=>$subject,
	*				 'content'=>$content,
	*				 'extendCode'=>$extendCode,
	*				 'applicationId'=>$ApplicationID,
	*				 'password'=>$Password,
	*				 'expectSendTime'=>$expectSendTime);
	*/
	public function sendMessage($paras){
		try {
			
			//第一个参数是方法名，第二个参数是数组(所有的方法的参数都放到数组中)
			if ($paras['expectSendTime']) {
				$result = $this->client->call('SendMessage4', $paras);
			}
			else {
				$result = $this->client->call('SendMessage3', $paras);
			}
			
			if ($this->client->fault) {
				echo '<h2>Fault</h2><pre>';
				print_r($result);
				echo '</pre>';
			} else {
				$err = $this->client->getError();
				if ($err) {
					echo '<h2>Error</h2><pre>' . $err . '</pre>';
				} else {
					echo '<h2>Request</h2><pre>' . htmlspecialchars($this->client->request, ENT_QUOTES) . '</pre>';
					echo '<h2>Response</h2><pre>' . htmlspecialchars($this->client->response, ENT_QUOTES) . '</pre>';
					echo '<h2>Debug</h2><pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';
					return $result;
				}
			}			
	 }
	 catch ( SoapFault $e ) { echo $e->getMessage (); }
	 catch ( Exception $e ) { echo $e->getMessage (); }
	}
   /*
	*	定时任务
	*	$paras = array('periodType'=>$periodType,
	*		 'periodValue'=>$periodValue,
	*		 'periodTime'=>$periodTime,
	*		 'destinationAddresses'=>$destinationAddresses,
	*		 'subject'=>$subject,
	*		 'content'=>$content,
	*		 'extendCode'=>$extendCode,
	*		 'applicationId'=>$ApplicationID,
	*		 'password'=>$Password,
	*		 'beginTime'=>$beginTime,
	*		 'endTime'=>$endTime);
	*/
	public function addTask($paras){
		try {
			
			//第一个参数是方法名，第二个参数是数组(所有的方法的参数都放到数组中)
			if ($paras['beginTime']&&$paras['endTime']) {
				$result = $this->client->call('AddTask4', $paras);
			}
			else {
				$result = $this->client->call('AddTask3', $paras);
			}
			
			if ($this->client->fault) {
				echo '<h2>Fault</h2><pre>';
				print_r($result);
				echo '</pre>';
			} else {
				$err = $this->client->getError();
				if ($err) {
					echo '<h2>Error</h2><pre>' . $err . '</pre>';
				} else {
					echo '<h2>Request</h2><pre>' . htmlspecialchars($this->client->request, ENT_QUOTES) . '</pre>';
					echo '<h2>Response</h2><pre>' . htmlspecialchars($this->client->response, ENT_QUOTES) . '</pre>';
					echo '<h2>Debug</h2><pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';
					return $result;
				}
			}			
	 }
	 catch ( SoapFault $e ) { echo $e->getMessage (); }
	 catch ( Exception $e ) { echo $e->getMessage (); }
	}
   /*
	*	删除定时
	*	$paras = array('taskId'=>$taskId);
	*/
	public function removeTask($paras){
		try {
			
			//第一个参数是方法名，第二个参数是数组(所有的方法的参数都放到数组中)
			$result = $this->client->call('RemoveTask', $paras);
			
			if ($this->client->fault) {
				echo '<h2>Fault</h2><pre>';
				print_r($result);
				echo '</pre>';
			} else {
				$err = $this->client->getError();
				if ($err) {
					echo '<h2>Error</h2><pre>' . $err . '</pre>';
				} 
			}		
			echo '<h2>Request</h2><pre>' . htmlspecialchars($this->client->request, ENT_QUOTES) . '</pre>';
			echo '<h2>Response</h2><pre>' . htmlspecialchars($this->client->response, ENT_QUOTES) . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';	
	 }
	 catch ( SoapFault $e ) { echo $e->getMessage (); }
	 catch ( Exception $e ) { echo $e->getMessage (); }
	}
	

   /*
	*	获取上行短信
	*	$paras = array('messageId'=>$messageId);
	*/
	public function getMessage($paras){
		try {
			
			//第一个参数是方法名，第二个参数是数组(所有的方法的参数都放到数组中)
			$result = $this->client->call('GetMessage', $paras);
			
			if ($this->client->fault) {
				echo '<h2>Fault</h2><pre>';
				print_r($result);
				echo '</pre>';
			} else {
				$err = $this->client->getError();
				if ($err) {
					echo '<h2>Error</h2><pre>' . $err . '</pre>';
				} else {
					echo '<h2>Request</h2><pre>' . htmlspecialchars($this->client->request, ENT_QUOTES) . '</pre>';
					echo '<h2>Response</h2><pre>' . htmlspecialchars($this->client->response, ENT_QUOTES) . '</pre>';
					echo '<h2>Debug</h2><pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';
					return $result;
				}
			}			
	 }
	 catch ( SoapFault $e ) { echo $e->getMessage (); }
	 catch ( Exception $e ) { echo $e->getMessage (); }
	}
	
	
}




?>