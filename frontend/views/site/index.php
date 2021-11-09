<?php

/* @var $this yii\web\View */

/**
 * @var $universityProvider \yii\data\ActiveDataProvider
 * @var $postProvider \yii\data\ActiveDataProvider
 * @var $reviews \common\models\Review
 * @var $banners \common\models\Banner
 * @var $phone \common\models\Phone
 */

$this->title = __("Perevod Consult");
?>

<main>
    <section>
        <div class="main-slider relative">
            <div class="swiper-container overflow-hidden" id="mainSlider">
                <div class="swiper-wrapper">
                    <?php foreach ($banners as $index => $banner):  ?>
                    <div class="swiper-slide">
                        <div class="full-slider relative text-white ">
                            <img class="full-slide-img w-full object-cover" src="<?=$banner->file->getSrc('medium')?>" alt="">
                            <span class="full-slide-gradient"> </span>
                            <div class="full-slide-text absolute inset-0 flex items-center">
                                <div class="container flex flex-col justify-center ">
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-12 sm:col-span-7">
                                            <p class="text-3xl sm:text-5xl mb-4 font-bold"><?php echo $banner->title[Yii::$app->language]?> </p>
                                            <a href="<?=\yii\helpers\Url::to(['university/index'])?>" class="primary-btn mt-6"><?=__(" Universitet
                                                tanlash")?> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div id="go" class="swiper-pagination main-pagination"></div>
            <a class="go-icon" href="#go"> <img src="/images/svg/to-bottom.svg" alt=""> </a>
        </div>
    </section>
    <section class="py-24" id="about">
        <div class="container">
            <div class="grid grid-cols-12 gap-0 xl:gap-x-24">
                <div class="col-span-12 xl:col-span-7" data-aos="fade-right">
                    <h2 class="text-3xl sm:text-5xl mb-4 leading-tight"><?=__(" Perevod Consult kompaniyasi natijalar bilan ishlaydi")?>.</h2>
                    <p class="text-black text-opacity-80"> <?=__("Hujjat tashvishlaridan, imtihon qiyinchiligidan cho'chiyapsizmi?
                        Bu borada biz — Perevod Consult — Sizga yordam beramiz. O'qishingizni ko'chirish uchun
                        hujjatlarni yig'ishda ko'mak berish bilan birga, o'qishni ko'chirishdagi davlat
                        imtihonlariga sizni tayyorgarlik ko'rishingiz uchun yaqindan yordam beramiz")?>. </p>
                </div>
                <div class="col-span-12 xl:col-span-5 flex justify-center" data-aos="fade-left"
                     data-aos-duration="1500">
                    <div class="about-video w-10/12 sm:w-80 xl:w-full mt-6 lg:mt-0">
                        <video class="h-60" id="myVideo" src="/images/videos/video.mp4"></video>
                        <a class="play-btn" id="playBtn" href="javacsript:void(0)">
                            <img src="/images/svg/play-icon.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-24">
        <div class="container">
            <h2 class="text-3xl mb-2 text-center"><?= __("Mashhur Universitetlar") ?></h2>
            <p class="text-black text-opacity-80 text-center"><?= __("Perevod Consult bilan talaba bo'lishingiz mumkin
                bo'lgan eng mashhur universitetlar") ?> </p>

            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $universityProvider,
                'itemView' => '_university_list',
                'options' => ['class' => 'grid pt-14 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  gap-x-8'],
                'itemOptions' => ['class' => 'feature-card'],
                'summary' => ''
            ])
            ?>

            <div class="flex justify-center">
                <a class="primary-btn flex items-center text-white"
                   href="<?= \yii\helpers\Url::to(['university/index']) ?>"> <?= __("Barchasini ko'rish") ?> <img
                            class="ml-2" src="/images/svg/arrow-right.svg" alt=""> </a>
            </div>
        </div>
    </section>
    <section class="pb-24 overflow-hidden">
        <div class="section-bg">
            <div class="container relative">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-20">
                    <div class="text-white w-max" data-aos="fade-up-left">
                        <h2 class="text-5xl sm:text-7xl font-bold mb-12"> <?=__("Natijalar")?>: </h2>
                        <div class="grid grid-cols-2  gap-y-12 gap-x-10">
                            <div class="pb-2 border-b">
                                <div class="text-3xl sm:text-7xl font-bold mb-2"> <span
                                            class="countIt">500</span>+
                                </div>
                                <div> <?= __("Universitet") ?></div>
                            </div>
                            <div class="pb-2 border-b">
                                <div class="text-3xl sm:text-7xl font-bold mb-2"> 457+</div>
                                <div><?= __("Bakalavriat") ?></div>
                            </div>
                            <div class="pb-2 border-b">
                                <div class="text-3xl sm:text-7xl font-bold mb-2"> 492+</div>
                                <div><?= __("Magistratura") ?></div>
                            </div>
                            <div class="pb-2 border-b">
                                <div class="text-3xl sm:text-7xl font-bold mb-2"> 10 785+</div>
                                <div><?= __("Talaba") ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="" data-aos="fade-up-right">
                        <h2 class="text-white text-center text-5xl sm:text-7xl font-bold mb-8"> <?= __("Fikrlar") ?>:</h2>
                        <div class="swiper overflow-hidden" id="cardsEffect">
                            <div class="swiper-wrapper">
                                <?php foreach ($reviews as $index => $review):?>
                                <div class="swiper-slide">
                                    <div
                                            class="p-8 bg-white rounded-2xl feedback-card flex flex-col justify-between">
                                        <q class="text-2xl mb-10">
                                            <?=$review->message?>
                                        </q>
                                        <div class="flex items-center">
                                            <img class="w-20 h-20 rounded-full border-2 mr-4"
                                                 src="https://picsum.photos/120/120" alt="">
                                            <div>
                                                <div class="text-2xl"><?=$review->getFullName()?></div>
                                                <div class="text-sm text-black text-opacity-90"><?=__("Student")?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                            <div class="swiper-pagination cards-slide-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-24">
        <div class="container">
            <h2 class="text-3xl mb-2 text-center"><?= __("Bloglar") ?></h2>
            <p class="text-black text-opacity-80 text-center"><?= __("Eng so'nggi xabarlar va foydali ma'lumotlar") ?> </p>
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $postProvider,
                'itemView' => '_blog',
                'options' => ['class' => 'pt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8'],
                'itemOptions' => ['class' => 'blog-card overflow-hidden rounded-md border border-opacity-90'],
                'summary' => ''
            ])
            ?>

            <div class="flex mt-10 justify-center">
                <a class="primary-btn flex items-center text-white" href="<?= \yii\helpers\Url::to(['post/index']) ?>">
                   <?=__("Barchasini ko'rish")?> <img
                            class="ml-2" src="/images/svg/arrow-right.svg" alt=""> </a>
            </div>
        </div>
    </section>
    <section class="pb-24">
        <div class="container">
            <h2 class="mb-4 text-2xl"> <?=__("Raqamingizni qoldiring")?> </h2>
            <div class="bg-primary py-11 px-4 sm:px-14 phone-part" data-aos="fade-up-left">
                <?php $form = \yii\widgets\ActiveForm::begin(['class' => 'flex flex-col sm:flex-row sm:justify-between']); ?>
                <div class="flex items-center">
                    <?= $form->field($phone, 'phone', ['template' => '{label}{input}'])
                        ->textInput(['class' => 'bg-transparent text-3xl sm:text-5xl text-white  outline-none border-b border-opacity-50 w-full lg:w-80 phone-inp', 'type' => 'tel', 'maxlength' => 9, 'id' => 'phone', 'placeholder' => '90 123 45 67', 'required' => true])
                        ->label('+998', ['class' => 'text-3xl sm:text-5xl text-white mr-4']) ?>
                </div>
                <div class="flex justify-end mt-6 sm:mt-0">
                    <button type="submit" class="py-4 px-14 bg-white text-lg rounded-xl"> <?=__("yuborish")?></button>
                </div>
                <?php \yii\widgets\ActiveForm::end() ?>
            </div>
        </div>
    </section>
</main>