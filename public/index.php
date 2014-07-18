<?php

// composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// change the following paths if necessary
$yii=dirname(__FILE__).'/../vendor/yiisoft/yii/framework/yiilite.php';
$config=dirname(__FILE__).'/../config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
