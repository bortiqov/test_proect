<?php

/* @var $this \yii\web\View */

/* @var $content string */


use common\modules\settings\models\Settings;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$currentLang = Yii::$app->language;
$languages = \common\components\Util::getActiveLanguages(Yii::$app->language);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html style="font-size: medium !important;" lang="<?= $currentLang ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <?php \frontend\assets\AppAsset::register($this);
    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/images/favicon.png']);
    ?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body class="vertical-layout">
<?php $this->beginBody() ?>
<div class="site-wrapper">
    <header class="site-header">
        <div class="container">
            <nav class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="pr-2 lg:pr-8">
                        <a class="main-logo flex" href="<?= \yii\helpers\Url::to(['/']) ?>">
                            <img src="/images/png/logo-red.png" alt="">
                        </a>
                    </div>
                    <ul class="site-nav pl-2 lg:pl-8 text-lg custom-border-left">
                        <li class="item-nav">
                            <a href="<?= \yii\helpers\Url::to(['page/about']) ?>"
                               class="item-link"> <?= __("About") ?> </a>
                        </li>
                        <li class="item-nav">
                            <a href="<?= \yii\helpers\Url::to(['university/index']) ?>"
                               class="item-link"> <?= __("University") ?> </a>
                        </li>
                        <li class="item-nav">
                            <a href="<?= \yii\helpers\Url::to(['gallery/index']) ?>"
                               class="item-link"> <?= __("Gallery") ?> </a>
                        </li>
                        <li class="item-nav">
                            <a href="<?= \yii\helpers\Url::to(['post/index']) ?>"
                               class="item-link"> <?= __("Blog") ?> </a>
                        </li>
                        <li class="item-nav">
                            <a href="<?= \yii\helpers\Url::to(['branch/index']) ?>"
                               class="item-link"> <?= __("Filial") ?> </a>
                        </li>
                    </ul>
                    <span class="nav-overlay"> </span>
                </div>
                <form action="<?= \yii\helpers\Url::to(['university/index']) ?>" method="get">
                    <div class="right-nav flex items-center">
                        <div class="pr-2 sm:pr-8 custom-border-right" id="moveToNav">
                            <div class="flex items-center search-part">
                                <a class="search-btn text-lg flex items-center hover:opacity-80 duration-75">
                                    <span class="search-text"><?= __("Поиск ") ?></span>
                                    <img class="ml-2 search-icon" src="/images/svg/search.svg" alt="">
                                    <img class="mr-2 close-icon" src="/images/svg/close.svg" alt="">
                                    <input class="search-input" name="UniversitySearch[name]" type="text">
                                </a>
                            </div>
                        </div>
                        <div class="pl-8 lang-drop">
                            <a class="text-lg lang-drop-active" href="#!"> <?= Inflector::camel2words($currentLang) ?>
                                <img src="/images/svg/flag<?= $currentLang ?>.svg" alt="">
                            </a>
                            <div class="lang-drop-menu hide">
                                <?php foreach ($languages as $language): ?>
                                    <a href="<?= \yii\helpers\Url::current(['language' => $language->code]) ?>"><?= Inflector::camel2words($language->code) ?>
                                        <img src="/images/svg/flag<?= $language->code ?>.svg" alt=""> </a>
                                <?php endforeach; ?>
                            </div>

                        </div>
                        <div class="hum-menu ml-4 md:hidden">
                            <div id="nav-icon1">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </form>
            </nav>

        </div>
    </header>
    <?= $content ?>
    <footer>
        <div class="bg-primary text-white py-12">
            <div class="container">
                <div class="flex flex-col sm:flex-row sm:justify-between  mb-8">
                    <a class="main-logo flex" href="<?=\yii\helpers\Url::to(['/'])?>">
                        <img src="/images/png/logo-white.png" alt="">
                    </a>
                    <nav>
                        <ul class="flex flex-wrap items-center sm:pl-8 text-lg custom-border-left">
                            <li class="item-nav">
                                <a href="<?= \yii\helpers\Url::to(['page/about']) ?>"
                                   class="item-link"> <?= __("About") ?> </a>
                            </li>
                            <li class="item-nav">
                                <a href="<?= \yii\helpers\Url::to(['univresity/index']) ?>"
                                   class="item-link"> <?= __("University") ?> </a>
                            </li>
                            <li class="item-nav">
                                <a href="<?= \yii\helpers\Url::to(['gallery/index']) ?>"
                                   class="item-link"> <?= __("Gallery") ?> </a>
                            </li>
                            <li class="item-nav">
                                <a href="<?= \yii\helpers\Url::to(['post/index']) ?>"
                                   class="item-link"> <?= __("Blog") ?> </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="flex flex-col-reverse sm:flex-row sm:justify-between">
                    <div class="flex flex-col text-xl">
                        <div class="flex items-center mb-4"><img class="mr-4" src="/images/svg/phone.svg" alt="">
                            <a class="hover-scale"
                               href="tel:<?= Settings::value(['slug' => 'phone']) ?>"><?= Settings::value(['slug' => 'phone']) ?></a>
                        </div>
                        <div class="flex items-center mb-4"><img class="mr-4" src="/images/svg/email.svg" alt="">
                            <a class="hover-scale"
                               href="mailto:<?= Settings::value(['slug' => 'email']) ?>"><?= Settings::value(['slug' => 'email']) ?>
                            </a>
                        </div>
                        <div class="flex items-center"><img class="mr-2" src="/images/svg/location-white.svg"
                                                            alt=""> <?= Settings::value(['slug' => 'address']) ?>
                        </div>
                    </div>
                    <div class="social flex mb-4 sm:mb-0">
                        <a class="ml-4 hover-scale h-max" href="<?=Settings::value(['facebook'])?>"> <img class="w-10  " src="/images/svg/fb.svg"
                                                                         alt="">
                        </a>
                        <a class="ml-4 hover-scale h-max" href="<?=Settings::value(['instagram'])?>"> <img class="w-10  " src="/images/png/ins.png"
                                                                         alt="">
                        </a>
                        <a class="ml-4 hover-scale h-max" href="<?=Settings::value(['telegram'])?>"> <img class="w-10  " src="/images/svg/tg.svg" alt="">
                        </a>
                    </div>
                </div>
                <p class="mt-4 text-right"> © 2021 Perevod Consult. Copyright 2021 All rights reserved </p>
            </div>
        </div>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
