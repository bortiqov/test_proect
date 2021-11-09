<?php

/**
 * @var $model \common\models\University
 */
/**
 * @var $otherUniversity \common\models\University
 */

$this->registerMetaTag(['name' => 'og:title', 'content' => strip_tags($model->getPrettyTitle())]);
$this->registerMetaTag(['name' => 'og:image', 'content' => $model->picture->getSrc('small')]);

?>

<main class="">
    <section>
        <div class=" relative text-white ">
            <img class="type-2 full-slide-img w-full object-cover" src="<?= $model->picture->getSrc('medium') ?>"
                 alt="">
            <span class="full-slide-gradient"> </span>
            <div class="full-slide-text absolute inset-0 flex items-center">
                <div class="container flex flex-col justify-center ">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 sm:col-span-9 lg:col-span-7">
                            <h1 class="text-3xl sm:text-5xl mb-4 font-bold"> <?= $model->getPrettyName() ?></h1>
                            <p class="text-xl sm:text-3xl flex items-center ">
                                <img class="mr-2" src="/images/svg/location-white.svg"
                                     alt=""><?= $model->getPrettyAddress() ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-24 pt-10">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3">
                <div class="lg:col-span-2 lg:pr-20 ">
                    <h2 class="text-3xl mb-5"><?= $model->getPrettyTitle() ?></h2>
                    <p class="text-black text-lg leading-8 text-opacity-80">
                        <?= $model->getPrettyDescription() ?>
                    </p>
                    <div class="mt-8">
                        <div class="text-2xl  flex items-center"><span> <?= __("Ulashing") ?>:  </span>
                            <div class="flex items-center ml-5">
                                <a class="mr-4 hover-scale" target="_blank" href="https://t.me/share?url=<?= \Yii::$app->urlManager->createAbsoluteUrl(['university/show', 'slug' => $model->slug]) ?>"> <img src="/images/png/telegram.png" alt=""> </a>
                                <a class="mr-4 hover-scale" target="_blank" rel="noopener" href="https://www.instagram.com/?url=<?=\Yii::$app->urlManager->createAbsoluteUrl(['university/show', 'slug' => $model->slug]) ?>"> <img src="/images/png/instagram.png" alt=""> </a>
                                <a class="hover-scale" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u=<?= \Yii::$app->urlManager->createAbsoluteUrl(['university/show', 'slug' => $model->slug]) ?>"> <img src="/images/png/facebook.png" alt=""> </a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-16">
                        <p class="text-2xl mb-4"> <?= __("Perevod Consult dan kerakli maslahatlarni oling") ?> </p>
                        <a href="tel:+998901234567"
                           class="bg-primary p-2 sm:p-4 text-xl sm:text-5xl text-white font-bold flex items-center w-max call-us">
                            <img class="mr-4 w-10 sm:w-auto" src="/images/svg/call-us.svg" alt="">
                            <span class="mr-2"><?=\common\modules\settings\models\Settings::value(['phone'])?></span>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-1 mt-14 lg:mt-0">
                    <h3 class="pb-2 mb-6 border-b  text-3xl"> <?= __("Boshqa Universitetlar") ?> </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1  gap-x-5 lg:gap-x-0">
                        <?php foreach ($otherUniversity as $index => $item): ?>
                            <a href="#" class="feature-card">
                                <div class="img-part">
                                    <img src="<?= $item->picture->getSrc('small') ?>" alt=""/>
                                </div>
                                <div class="text-part">
                                    <div class="title"><?= $item->getPrettyName() ?></div>
                                    <div class="text">
                                        <img class="mr-2"
                                             src="/images/svg/location.svg"> <?= $item->getPrettyAddress() ?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>


