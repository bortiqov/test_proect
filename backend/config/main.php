<?php

use common\modules\user\models\User;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => \common\modules\user\modules\admin\Module::class,
        'post' => \common\modules\post\modules\admin\Module::class,
        'file' => \common\modules\file\modules\admin\Module::class,
        'settings' => \common\modules\settings\modules\admin\Module::class,
        'pages' => \common\modules\pages\modules\admin\Module::class,
        'translation' => \common\modules\translation\modules\admin\Module::class,

    ],
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
//            'class' => 'codemix\localeurls\UrlManager',
//            'languages' => ['ru', 'uz', 'en'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [],
                    'css' => [],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'js' => [],
                    'css' => [],
                ],
            ],
        ],

    ],
    'on beforeAction' => function () {
        common\modules\language\components\Lang::onRequestHandler();

        if (\Yii::$app->request->url != '/site/login' && \Yii::$app->user->isGuest) {
            \Yii::$app->response->redirect(['site/login']);
        }
    },

    'params' => $params,
];
