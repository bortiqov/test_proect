<?php

/**
 * @var $dataProvider \yii\debug\models\timeline\DataProvider
 * @var $banner \common\models\Banner
 */
?>

<main class="">
    <section>
        <div class=" relative text-white ">
            <img class="type-2 full-slide-img w-full object-cover" src="<?=$banner->file->getSrc('medium')?>" alt="">
            <span class="full-slide-gradient"> </span>
            <div class="full-slide-text absolute inset-0 flex items-center">
                <div class="container flex flex-col justify-center ">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 sm:col-span-7">
                            <h1 class="text-3xl sm:text-5xl mb-4 font-bold"><?=$banner->title[Yii::$app->language]?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-24 pt-10">
        <div class="container">
            <h2 class="text-3xl mb-2 text-center"><?=__(" Universitetlar")?></h2>
            <p class="text-black text-opacity-80 text-center"><?=__("Talaba bo'lishingiz mumkin
                bo'lgan nufuzli oliygohlar")?></p>

            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView'  => '_list_item',
                'options' => ['class' => 'grid pt-14 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  gap-x-8'],
                'itemOptions' =>'',
                'summary' => ''
            ])
            ?>
        </div>
    </section>
</main>


