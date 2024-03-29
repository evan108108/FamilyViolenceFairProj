<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Risk Factors & Correlates for IPV',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.modules.right.*',
    'application.modules.rights.components.*',
    'application.modules.poll.models.*',
    'application.modules.poll.components.*',
    'ext.bootstrap.widgets.*'
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Password1',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
      'ipFilters'=>array('127.0.0.1','::1'),
      'generatorPaths'=>array(
        'bootstrap.gii', // since 0.9.1
      ),
		),
		'user'=>array(
			'tableUsers' => 'users',
			'tableProfiles' => 'profiles',
			'tableProfileFields' => 'profiles_fields',
		
		),
		'rights'=>array(
			//'install'=>true,
    ),
    'poll' => array(
      // Force users to vote before seeing results
      'forceVote' => False,
      // Restrict anonymous votes by IP address,
      // otherwise it's tied only to user_id 
      'ipRestrict' => TRUE,
      // Allow guests to cancel their votes
      // if ipRestrict is enabled
      'allowGuestCancel' => FALSE,
    ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'RWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/user/login'),
    ),
    'bootstrap'=>array(
        'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
    ),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'connectionID'=>'db',
			'defaultRoles'=>array('Authenticated', 'Guest'),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=fvfp',
			'emulatePrepare' => true,
			'username' => 'admin',
			'password' => '',
			'charset' => 'utf8',
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
	),
);
