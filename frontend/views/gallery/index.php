<?php
/**
 * @var $this \common\components\View
 * @var $banner \common\models\Banner
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

?>

<main class="">
    <section>
        <div class=" relative text-white ">
            <img class="type-2 full-slide-img w-full object-cover " src="<?=$banner->file->getSrc('small')?>" alt="">
            <span class="full-slide-gradient"> </span>
            <div class="full-slide-text absolute inset-0 flex items-center">
                <div class="container flex flex-col justify-center ">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 sm:col-span-9 lg:col-span-7">
                            <h1 class="text-3xl sm:text-5xl mb-4 font-bold"> <?=$banner->title[Yii::$app->language]?> </h1>
                            <p class="text-xl sm:text-3xl flex items-center ">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4">

        <?php echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_gallery_list',
            'options' => ['class' => 'masonry before:box-inherit after:box-inherit'],
            'itemOptions' => ['class' => 'break-inside p-8 my-6 bg-gray-100 rounded-lg'],
            'summary' => ''
        ])?>
    </section>
</main>



