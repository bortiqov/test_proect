<?php

/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $banner \common\models\Banner
 */

?>
<main class="">
    <section>
        <div class=" relative text-white ">
            <img class="type-2 full-slide-img w-full object-cover " src="<?=$banner->file->getSrc('medium')?>" alt="">
            <span class="full-slide-gradient"> </span>
            <div class="full-slide-text absolute inset-0 flex items-center">
                <div class="container flex flex-col justify-center ">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 sm:col-span-9 lg:col-span-7">
                            <h1 class="text-3xl sm:text-5xl mb-4 font-bold"><?=$banner->title[Yii::$app->language]?></h1>
                            <p class="text-xl sm:text-3xl flex items-center ">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-4 pb-64">
        <div class="container">
            <h2 class="text-3xl mb-8"> <?= __("Bizning Filiallar") ?>: </h2>
            <div>
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_branch_list',
                    'options' => ['tag' => 'ul','class' => 'lg:mx-8 grid grid-cols-1 sm:grid-cols-2  lg:grid-cols-3 gap-8 xl:grid-cols-4 xl:gap-10'],
                    'itemOptions' => ['tag' => 'li','class' => 'fillial-card flex px-5 py-8 border border-opacity-50'],
                    'summary' => ''
                ]) ?>
            </div>
        </div>
    </section>

    </li>
</main>
