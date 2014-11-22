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

class Receive{
	private $client = null;
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
	*	NotifyMms
	*/
	public function notifyMms($paras){
		try {
			
			$result = $this->client->call('NotifySms', $paras);
			
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
	*	NotifySmsDeliveryReport
	*/
	public function notifySmsDeliveryReport($paras){
		try {
			
			$result = $this->client->call('NotifySmsDeliveryReport', $paras);
			
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
	*	NotifyMms
	*/
	public function notifyMms($paras){
		try {
			
			$result = $this->client->call('NotifyMms', $paras);
			
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
	*	NotifyMmsDeliveryReport
	*/
	public function notifyMmsDeliveryReport($paras){
		try {
			
			$result = $this->client->call('NotifyMmsDeliveryReport', $paras);
			
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