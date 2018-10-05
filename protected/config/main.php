<?php

// uncomment the following to define a path alias
Yii::setPathOfAlias('bootstrap',dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'jump',

	'theme'=>'bootstrap', 

    'sourceLanguage'=>'en',
    'language' => 'en',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
		    'class'=>'system.gii.GiiModule',
		    'password'=>'yii',
	            'generatorPaths'=>array(
        	        'bootstrap.gii',
	             ),
		),
	),

	// application components
	'components'=>array(
		// CONFIGURACION ENTORNO DE DESARROLLO
		 'facebook'=>array(
    			'class' => 'ext.yii-facebook-opengraph.SFacebook',
			'appId'=>'459955770791656', // needed for JS SDK, Social Plugins and PHP SDK
		        'secret'=>'a33c240758ceb3ca1e5246f3c255cfcc', // needed for the PHP SDK
		        'fileUpload'=>false, // needed to support API POST requests which send files
		        'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
			'locale'=>'en_US', // override locale setting (defaults to en_US)
		        'jsSdk'=>true, // don't include JS SDK
		        'async'=>true, // load JS SDK asynchronously
		        'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
			'status'=>true, // JS SDK - check login status
		        'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
			'oauth'=>true,  // JS SDK - enable OAuth 2.0
		        'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
		        'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
		        'html5'=>true,  // use html5 Social Plugins instead of XFBML
		        'ogTags'=>array(  // set default OG tags
			        'title'=>'jump',
			        'description'=>'jump',
			        'image'=>'',
			),
		),
		/*
		  CONFIGURACION ENTORNO DE PRODUCCION
		 'facebook'=>array(
    			'class' => 'ext.yii-facebook-opengraph.SFacebook',
			'appId'=>'462930857098421', // needed for JS SDK, Social Plugins and PHP SDK
		        'secret'=>'bb7465099f323427c01efe224c7bd311', // needed for the PHP SDK
		        'fileUpload'=>false, // needed to support API POST requests which send files
		        'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
			'locale'=>'en_US', // override locale setting (defaults to en_US)
		        'jsSdk'=>true, // don't include JS SDK
		        'async'=>true, // load JS SDK asynchronously
		        'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
			'status'=>true, // JS SDK - check login status
		        'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
			'oauth'=>true,  // JS SDK - enable OAuth 2.0
		        'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
		        'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
		        'html5'=>true,  // use html5 Social Plugins instead of XFBML
		        'ogTags'=>array(  // set default OG tags
			        'title'=>'jump',
			        'description'=>'jump',
			        'image'=>'',
			),
		),
		*/
        	'bootstrap'=>array(
	        	'class'=>'bootstrap.components.Bootstrap',
        	),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
                /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                */
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=jump',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '1234',
			'charset' => 'utf8',
		),

		'session' => array (
			'autoStart' => true,
		    'class' => 'system.web.CDbHttpSession',
		    'connectionID' => 'db',
		    'sessionTableName' => 'jump_session',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
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
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'identity-provider' => 'Facebook-OpenGraph',
		'interest-provider' => 'jwmoz-Pinterest',
	),
);
