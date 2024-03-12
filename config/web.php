<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
  'id' => 'basic',
  'language' => 'es-MX',
  'timezone' => 'America/Mexico_City',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
  ],
  'modules' => [
    'gridview' =>  [
      'class' => '\kartik\grid\Module'
    ]
  ],
  'components' => [
    'assetManager' => [
      'appendTimestamp' => true
    ],
    'request' => [
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'ORFu46n7ui1EKltXeCDX8_1_UTq9CLlR',
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'user' => [
      'identityClass' => 'app\models\usuario\Usuario',
      'enableAutoLogin' => true,
    ],
    'authManager' => [
      'class' => 'yii\rbac\DbManager',
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],
//    'mailer' => [
//      'class' => 'yii\symfonymailer\Mailer',
//      'viewPath' => '@app/mail',
//      'useFileTransport' => false,
//      'transport' => [
////        'dsn' => 'smtps://webmaster@chefonline.com.mx:3!C0r2sis!M4st3r4@mail.chefonline.com.mx:587',
//        'scheme' => 'smtps',
//        'host' => 'mail.chefonline.com.mx',
//        'username' => 'webmaster@chefonline.com.mx',
//        'password' => '3!C0r2sis!M4st3r4',
//        'port' => 587,
//        'dsn' => 'native://default',
//      ]
//    ],
    'mailer' => [
      'class' => 'yii\swiftmailer\Mailer',
      'useFileTransport' => false,
      'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'mail.chefonline.com.mx',
        'username' => 'webmaster@chefonline.com.mx',
        'password' => '3!C0r2sis!M4st3r4',
        'port' => '587',
//        'encryption' => 'tls',
      ]
    ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'db' => $db,

    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
    ],

  ],
  'params' => $params,
];

if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1'],
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1'],
  ];
}

return $config;
