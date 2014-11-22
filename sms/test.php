<?php

require_once('MmsBuilder.php');
require_once('MmsConst.php');
require_once('MmsContent.php');

	$Mms = new MmsContent();
	$temp = new MmsBuilder();

	$Mms->CreateFromFile("C:\\logo.gif");

	
	$temp->AddContent($Mms);

	//$Mms = new MmsContent();
	$Mms->CreateFromBytes(base64_encode('你好'));
	$Mms->Charset='gbk2312';
	$Mms->ContentID='2';
	$Mms->ContentType=$TEXT;
	
	$temp->AddContent($Mms);

	echo $temp->BuildContentToXml();
?>