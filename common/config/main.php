<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
        	'class' => 'yii\web\UrlManager',
        	'showScriptName' => false,
        	'enablePrettyUrl' => true,

        	'rules' => [
                'admin' => 'admin/default/index',
                'admin/<controller:\w+>/<id:\d+>' => 'admin/<controller>/view',
                'admin/<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',
                'admin/<controller:\w+>/<action:\w+>/<id:\d+>'=>'admin/<controller>/<action>',
                '<controller:\w+>' => '<controller>/index',
        		'<controller:\w+>/<id:\d+>' => '<controller>/view',
        		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        		'<controller:\w+>/<action:download-img|download-doc>/<id:\d+>' => '<controller>/<action>',



        	]
        ]
    ],
];
