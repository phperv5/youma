<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' =>'',
    #'defaultController'=>'Api/2b',
    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.IP.*',
        'application.controllers.*',
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        /**/
    ),

    // application components
    'components' => array(

        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),

        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false, //隐藏index.php
            'urlSuffix' => '.html', //后缀
            'caseSensitive' => true, //设置对大小写不敏感
            'rules' => array(
		'red/<key:[\S]+>' => 'RedScan/scan/key/<key>/',
             	'item/<key:[\S]+>' => 'ItemScan/scan/key/<key>/',
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'error' => 'error/index',
                '<key:[\S]+>' => 'Scan/Scan/key/<key>/',
            ),
        ),

        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'cache' => array(
            'class' => 'ext.redis.CRedisCache',
            'servers' => array(
                /*测试环境*/
                array(
                    'host' => '127.0.0.1',
                    'port' => 6379,
                  //  'password' => 'zhuang0716'
                ),
            ),
        ),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),

    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'CACHE_APP_KEY' => 'youmahe.yii.access.',
    ),
);
