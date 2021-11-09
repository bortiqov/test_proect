<?php
/**
 * @var $model \common\modules\pages\models\Pages
 * @var $users \common\modules\user\models\User[]
 * @var $phone \common\models\Phone
 */

?>

<main class="">
    <section class="" id="about">
        <div class="container">
            <h1 class="text-3xl text-center py-12"> <?= __("Biz haqimizda") ?> </h1>
            <div class="grid grid-cols-12 gap-0 xl:gap-x-24">
                <div class="col-span-12 xl:col-span-7" data-aos="fade-right">
                    <h2 class="text-2xl  mb-4 leading-tight"> <?= __("Perevod Consult kompaniyasi natijalar
                        bilan ishlaydi") ?>.</h2>
                    <p class="text-black text-opacity-80 leading-10 text-justify"> <?= $model->description[Yii::$app->language] ?> </p>
                    <?= $model->content[Yii::$app->language] ?>
                </div>
                <div class="col-span-12 xl:col-span-5 flex justify-center" data-aos="fade-left"
                     data-aos-duration="1500">
                    <div class="about-video w-10/12 sm:w-80 xl:w-full mt-6 lg:mt-0">
                        <video class="h-60" id="myVideo" src="/images/videos/about.mp4"></video>
                        <a class="play-btn" id="playBtn" href="javacsript:void(0)">
                            <img src="/images/svg/play-icon.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16">
        <div class="container">
            <h2 class="text-3xl text-center pb-12"> <?= __("Bizning Jamoa ") ?></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-10">
                <?php foreach ($users as $index => $user): ?>
                    <div class="flex items-center flex-col ">
                        <div class="rounded-full relative"><img
                                    class="w-52 h-52 rounded-full object-cover p-1 main-shadow"
                                    src="<?= $user->avatar ? $user->avatar->getSrc('small') : "" ?>" alt=""></div>
                        <div class="flex flex-col items-center justify-end w-full h-48 -mt-16 p-8 bg-white main-shadow rounded">
                            <p class="pt-4 text-2xl"><?= $user->getFullName() ?> </p>
                            <div class="text-black text-opacity-80 pt-2"><?=__("Manager")?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section class="pb-24">
        <div class="container">
            <h2 class="mb-4 text-2xl"><?= __(" Raqamingizni qoldiring ") ?></h2>
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
