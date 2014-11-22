<?php
defined('YII_DEBUG') or define('YII_DEBUG',false);
date_default_timezone_set('Asia/Shanghai');
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode

// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',5);

require_once($yii);
Yii::createApplication('WebApplication',$config)->run();
