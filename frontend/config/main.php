<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return array(
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => array('log'),
    'controllerNamespace' => 'frontend\controllers',
    'components' => array(
        'request' => array(
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ),
        'user' => array(
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => array('name' => '_identity-frontend', 'httpOnly' => true),
        ),
        'session' => array(
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ),
        'log' => array(
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => array(
                array(
                    'class' => 'yii\log\FileTarget',
                    'levels' => array('error', 'warning'),
                ),
            ),
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),

        'urlManager' => array(
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['uz', 'ru', 'en'],
            'scriptUrl' => '/index.php',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array(
                'university/show/<slug:\S+>' => 'university/show',
                'post/show/<slug:\S+>' => 'post/show',
                'page/<slug:\S+>' => 'page/index',
            ),
        ),

    ),
    'params' => $params,
);
