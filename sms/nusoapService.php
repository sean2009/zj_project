<?php
    require_once("nusoap.php");
	include_once("db.inc.php");
    require_once("deliveryReport.php");
    $server = new soap_server;



    //避免乱码

    $server->soap_defencoding = 'UTF-8';
    $server->decode_utf8 = false;
    $server->xml_encoding = 'UTF-8';
    $server->configureWSDL('mms_rtn');//打开wsdl支持
    $server->configureWSDL('NotifySms');//打开wsdl支持
    $server->configureWSDL('NotifySmsDeliveryReport');//打开wsdl支持
    $server->configureWSDL('NotifyMms');//打开wsdl支持
    $server->configureWSDL('NotifyMmsDeliveryReport');//打开wsdl支持

	$server->wsdl->addComplexType('DeliveryReport','complexType','struct','all','',
			array('messageDeliveryStatus'=>array('name'=>'messageDeliveryStatus','type'=>'xsd:string'),
				  'messageId'=>array('name'=>'messageId','type'=>'xsd:string'),
				  'receivedAddress'=>array('name'=>'receivedAddress','type'=>'xsd:string'),
				  'sendAddress'=>array('name'=>'sendAddress','type'=>'xsd:string'),
				  'statusCode'=>array('name'=>'statusCode','type'=>'xsd:string')));
	
	/*
       注册需要被客户端访问的程序
       类型对应值：bool->"xsd:boolean"   string->"xsd:string" 
                int->"xsd:int"    float->"xsd:float"
    */
	//短信接收
    $server->register('NotifyMms',    //方法名 
    array("messageId"=>"xsd:string") );//返回值，默认为"xsd:string"

    //短信接收
    $server->register('NotifySms',    //方法名
    array("messageId"=>"xsd:string") );//返回值，默认为"xsd:string"

	
	//短信状态报告接收
	$server->register('NotifySmsDeliveryReport', array('deliveryReport'=>'tns:DeliveryReport'), array("return"=>"xsd:string") );
	//彩信状态报告接收
	$server->register('NotifyMmsDeliveryReport', array('deliveryReport'=>'tns:DeliveryReport'), array("return"=>"xsd:string") );

    //isset 检测变量是否设置
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    //service 处理客户端输入的数据
    $server->service($HTTP_RAW_POST_DATA);
   
    /**
     * 短信接收
     * @param $id
     */
    function NotifySms($messageId) {
		//$handle = fopen('test.log', "w ");
		//fwrite($handle,"jety打发");
		//fclose($handle);
		//$db=new DBSQL;
		//$s_id=time();
		//$sql="update  person set UNITS  = '".$messageId."'";
		//$rtn = $db->update($sql);

    }

    /**
     * 短信状态报告接收
     * @param $deliveryReport
     */
	function NotifySmsDeliveryReport($deliveryReport) {

		//$db=new DBSQL;
		//$s_id=time();
		//$sql="update  person set UNITS  = '".$deliveryReport['receivedAddress']."'";
		//$rtn = $db->update($sql);

		//return $deliveryReport['receivedAddress'];
		
	}
    /**
     * 彩信接收
     * @param $id
     */
    function NotifyMms($messageId) {
		//$db=new DBSQL;
		//$s_id=time();
		//$sql="update  person set UNITS  = '".$messageId."'";
		//$rtn = $db->update($sql);

    }

    /**
     * 彩信状态报告接收
     * @param $deliveryReport
     */
	function NotifyMmsDeliveryReport($deliveryReport) {

		//$db=new DBSQL;
		//$s_id=time();
		//$sql="update  person set UNITS  = '".$deliveryReport['receivedAddress']."'";
		//$rtn = $db->update($sql);

		//return $deliveryReport['receivedAddress'];
		//return "jetty";
	}

?>