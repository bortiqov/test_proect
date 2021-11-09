<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/images/favicon.png',
        'css/styles.css',
        'css/swiper-bundle.min.css',
        'css/aos.css',
        'css/main.css',
    ];
    public $js = [
        'js/swiper-bundle.min.js',
        'js/vanilla-tilt.min.js',
        'js/aos.js',
        'js/index.js',

    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
