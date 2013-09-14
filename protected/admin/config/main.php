<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
//前台地址
$frontend=dirname(dirname(dirname(__FILE__)));
Yii::setPathOfAlias('frontend', $frontend);
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'language'=>'zh_cn',
	'timeZone'=>'Asia/Shanghai',
	'name'=>'问答系统!-后台管理',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'frontend.models.*',
		'frontend.helpers.*',
		'application.components.*',
		'application.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		//设置缓存
		'cache'=>array(
				'class'=>'system.caching.CFileCache',
			),
		//防止 CSRF 跨站式伪造
		'request'=>array(
					'enableCsrfValidation'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,//注意false不要用引号括上
			'urlSuffix'=>'.html',
			//规则
			'rules'=>array(
					'<controller:\w+>/<id:\d+>/'=>'<controller>/view/',
					
			),
		),
		*/
		/*
		 'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ask',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123',
			'tablePrefix' => 'ask_',
			'charset' => 'utf8',
			'enableProfiling'=>true,
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'Public/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				// array(
				// 	'class'=>'CWebLogRoute',
				// ),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__) . '/params.php'),
);
