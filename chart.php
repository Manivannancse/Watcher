<?php
$yii = dirname(__FILE__).'/../yii/framework/yii.php';
$config = dirname(__FILE__).'/protected/config/main.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
    require_once('phpChart/conf.php');
Yii::createWebApplication($config)->run();

