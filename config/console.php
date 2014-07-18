<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Console Yii Skeleton',
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    // preloading 'log' component
    'preload' => array('log'),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'pgsql:host=localhost;dbname=skeleton',
            'emulatePrepare' => true,
            'username' => '',
            'password' => '',
            'charset' => 'utf8'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);
