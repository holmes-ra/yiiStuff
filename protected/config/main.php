<?php
/**
 * C:\Users\Ryan\AppData\Roaming\Sublime Text 2\Packages/PhpTidy/phptidy-sublime-buffer.php
 *
 * @package default
 */


// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'what this is I don\'t even',
	'theme'=>'',
	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		'ext.yapeal.models.*',
		'ext.pheal.*',
		'ext.giix-components.*', // giix components
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'giiPassword',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('192.168.1.*', '::1'),
			'generatorPaths' => array(
				'ext.giix-core',
				'bootstrap.gii'),
		),

		'rights'=>array(
			'install'=>false,
		),

		'message' => array(
			'userModel' => 'Users',
			'getNameMethod' => 'getFullName',
			'getSuggestMethod' => 'getSuggest',
			'viewPath' => '/message/fancy',
		),

		'user'=>array(
			// salt encryption (change this to something random)
			'salt' => 'jb4387fb2f7c2f329',
			// send activation email
			'sendActivationMail' => true,
			// allow access for non-activated users
			'loginNotActiv' => false,
			// activate user on registration (only sendActivationMail = false)
			'activeAfterRegister' => false,
			// automatically login from registration
			'autoLogin' => false,
			// registration path
			'registrationUrl' => array('/user/registration'),
			// recovery password path
			'recoveryUrl' => array('/user/recovery'),
			// login form path
			'loginUrl' => array('/user/login'),
			// page after login
			'returnUrl' => array('/user/profile'),
			// page after logout
			'returnLogoutUrl' => array('/user/login'),
		),
	),

		// application components
		'components'=>array(
			'bootstrap' => array(
				'class' => 'ext.bootstrap.components.Bootstrap',
				'responsiveCss' => true,
			),

			'user'=>array(
				'class'=>'RWebUser',
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
				'loginUrl'=>array('/user/login'),
				'autoUpdateFlash' => false,
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
				'connectionString' => 'mysql:host=localhost;dbname=yiiTest',
				'emulatePrepare' => true,
				'username' => 'yiiUser',
				'password' => 'myPassword',
				'charset' => 'utf8',
				'tablePrefix' => '',
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
					
				array(
					'class'=>'CWebLogRoute',
				),
				
				),
			),
		),

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>array(
			// this is used in contact page
			'adminEmail'=>'ryan.xgamer99@gmail.com',
		),
	);







	
