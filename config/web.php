<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'name' => getenv('TITLE'),
    'timeZone' => 'Africa/Nairobi',
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap5\BootstrapAsset' => [
                    'css' => [],
                ],
                // You can also disable other Bootstrap related bundles if needed.
                'yii\bootstrap5\BootstrapPluginAsset' => [
                     'js' => [],
                ],
                'yii\web\JqueryAsset' => [
                    'js' => [],
                ],
            ],
        ],
        'request' => [
            'enableCsrfValidation' => true,
            'cookieValidationKey' => '2XxPW3T013aN2e40iVmUSmSU3J2BBsrH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\auth\User',
            'enableAutoLogin' => false,
            'authTimeout' => 60 * 60, // 1 Minute ,
            'idParam' => '__cid',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'BC_Service' => [
            'class' => 'app\Library\BcService',
        ],
        'core' => [
            'class' => 'app\Library\Core',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'useFileTransport' => false,
            'viewPath' => '@app/mail',
            'transport' => [
                'scheme' => 'smtp',
                'host' => getenv('SMTP_SERVER'),
                'username' => getenv('SMTP_USERNAME'),
                'password' => getenv('SMTP_PASSWORD'),
                'port' => getenv('SMTP_PORT'),
                'encryption' => getenv('SMTP_ENCRYPTION'),
                'options' => [
                    'verify_peer' => 0,
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/runtime/logs/app.log',
                    'logVars' => [],
                    'except' => [
                        'yii\web\Session::open',
                        'yii\web\Session::close',
                        'yii\web\Session::regenerateID',
                        'yii\web\Session::writeSession',
                        'yii\web\CookieCollection::*',
                        '_SERVER',
                        '_SESSION',
                        '_COOKIE',
                        '_FILES',
                        '_POST',
                    ],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'approval/<controller:\w+>/<action:\w+>' => 'approval/<controller>/<action>',
                'change/<controller:\w+>/<action:\w+>' => 'change/<controller>/<action>',
                'contract/<controller:\w+>/<action:\w+>' => 'contract/<controller>/<action>',
                'hr/<controller:\w+>/<action:\w+>' => 'hr/<controller>/<action>',
                'imprest/<controller:\w+>/<action:\w+>' => 'imprest/<controller>/<action>',
                'store/<controller:\w+>/<action:\w+>' => 'store/<controller>/<action>',
                'leave/<controller:\w+>/<action:\w+>' => 'leave/<controller>/<action>',
                'overtime/<controller:\w+>/<action:\w+>' => 'overtime/<controller>/<action>',
                'appraisal/<controller:\w+>/<action:\w+>' => 'appraisal/<controller>/<action>',
                'recruitment/<controller:\w+>/<action:\w+>' => 'recruitment/<controller>/<action>',
                'report/<controller:\w+>/<action:\w+>' => 'report/<controller>/<action>',
                'separation/<controller:\w+>/<action:\w+>' => 'separation/<controller>/<action>',
                'resource/<controller:\w+>/<action:\w+>' => 'resource/<controller>/<action>',
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_env_DEV) {
    // configuration adjustments for 'dev' getenvironment
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
