<?php

/**
 * @var $model \common\modules\post\models\Post
 */
?>

<a href="<?=\yii\helpers\Url::to(['post/show','slug' => $model->slug])?>" class="">
    <div class="w-full h-48 overflow-hidden">
        <img class="h-full w-full object-cover blog-card-img"
             src="<?= $model->picture->getSrc('small') ?>" alt="blog-image">
    </div>
    <div class="p-4">
        <h3 class="mb-4 text-2xl"><?= $model->getPrettyTitle() ?></h3>
        <p class="text-sm text-black text-opacity-90"><?= $model->getPrettyAnons() ?></p>
    </div>
</a>
