<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$db_host = '127.0.0.1';
$db_port = '3306';
$db_user = 'root';
$db_pwd = '';
$db_name = 'php_banjie';



$config = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '浙江省省经济合作交流办公室',
    'language' => 'zh_cn',
    'defaultController' => 'index',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.service.*',
        'application.extensions.yiidebugtb.*',
		'application.extensions.message.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '111',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'admin',
    ),
    // application components
    'components' => array(
        'adminuser' => array(
            'class' => 'CWebUser',
            'allowAutoLogin' => false,
            'stateKeyPrefix' => 'sdf'
        ),
        'db' => array(
            'connectionString' => "mysql:host={$db_host};port={$db_port};dbname={$db_name}",
            'emulatePrepare' => true,
            'username' => $db_user,
            'password' => $db_pwd,
            'charset' => 'utf8',
            'tablePrefix' => 'bj_',
            'schemaCachingDuration' => 0
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache'
        ),
        // uncomment the following to use a MySQL database
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'public/error',
        ),
//        'log' => array(
//            'class' => 'CLogRouter',
//            'routes' => array(
//                array(
//                    'class' => 'XWebDebugRouter',
//                    'config' => 'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
//                    'levels' => 'error, warning , info,trace',
//                    'allowedIPs' => array('127.0.0.1', '::1', '10\.1\.2\.[0-9]{1}', '10\.1\.2\.[0-9]{2}', '10\.1\.2\.[0-9]{3}'),
//                ),
//            ),
//        ),
    ),
	'params'=>require(dirname(__FILE__) . '/params.php'),
);
return $config;