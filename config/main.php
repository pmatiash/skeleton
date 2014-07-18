<?php
// defines
require_once realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'defines.php';

Yii::setPathOfAlias('module', realpath(dirname(__FILE__) . '/..') . '/modules/');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yii Skeleton',
    'language' => 'en',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.forms.*',
        'application.widgets.*',
    ),
    'defaultController' => 'index',

    'modules' => array(
        'admin' => array(
            'class' => 'module\admin\AdminModule',
            'registerModels'    => array(
                'application.models.*',
            ),
            'defaultController' => 'page',
        ),
    ),

    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'class'             => 'WebUser',
            'allowAutoLogin'    => true,
            'loginUrl'          => array('/auth/login'),
            'returnUrl'         => ['index'],
        ),
        'authManager'  => array(
            'class'        => 'AuthManager',
            'defaultRoles' => array('guest'),
            'authFile'      => __DIR__ . '/acl.php',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName'=>false,
            'rules' => array(
                'admin' => 'admin/page/list',
                '<alias:\w+>' => 'page/view',
                '<module:\w+>' => '<module>/index',
                '<module:\w+>/<controller:\w+>' => '<module>/<controller>/index',
                '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',

            ),
        ),
        'session' => array(
            'sessionName' => 's',
            'autoStart' => false,
        ),
        'db' => array(
            'connectionString' => 'pgsql:host=localhost;dbname=skeleton',
            'emulatePrepare' => true,
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'error/error',
        ),
        'response'     => array(
            'class' => 'Response',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CDbLogRoute',
                    'connectionID' => 'db',
                    'levels' => 'info, profile, warning, error',
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'web.4life@yahoo.com',
    ),
);
