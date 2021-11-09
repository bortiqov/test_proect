<?php

/**
 * @var $model \common\modules\post\models\Post
 */
/**
 * @var $newModel \common\modules\post\models\Post
 */


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
                            <h1 class="text-3xl sm:text-5xl mb-4 font-bold"><?= $model->getPrettyTitle() ?> </h1>
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
                    <?= $model->getPrettyDescription() ?>
                    <div class="mt-8">
                        <div class="text-2xl  flex items-center"><span> <?=__("Ulashing")?>: </span>
                            <div class="flex items-center ml-5">
                                <a class="mr-4 hover-scale " href="#"> <img src="/images/png/telegram.png"
                                                                            alt=""> </a>
                                <a class="mr-4 hover-scale " href="#"> <img src="/images/png/instagram.png"
                                                                            alt=""> </a>
                                <a class="hover-scale " href="#"> <img src="/images/png/facebook.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-1 mt-14 lg:mt-0">
                    <h3 class="pb-2 mb-6 border-b  text-3xl"> <?= __("Boshqa Bloglar") ?> </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1  gap-x-5 lg:gap-x-0 gap-y-6">
                        <?php foreach ($newModel as $index => $item): ?>
                            <a href="#" class="blog-card overflow-hidden rounded-md border border-opacity-90">
                                <div class="w-full h-48 overflow-hidden">
                                    <img class="h-full w-full object-cover blog-card-img"
                                         src="<?= $item->picture->getSrc('small') ?>" alt="">
                                </div>
                                <div class="p-4">
                                    <h3 class="mb-4 text-2xl"><?= $model->getPrettyTitle() ?></h3>
                                    <p class="text-sm text-black text-opacity-90"><?= $model->getPrettyAnons() ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
