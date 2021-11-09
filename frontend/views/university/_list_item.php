<?php
/**
 * @var $model \common\models\University
 */
?>

<a href="<?=\yii\helpers\Url::to(['university/show','slug' => $model->slug])?>" class="feature-card">
    <div class="img-part">
        <img src="<?=$model->picture->getSrc('small')?>" alt=""/>
    </div>
    <div class="text-part">
        <div class="title"><?=$model->getPrettyName()?></div>
        <div class="text">
            <img class="mr-2" src="/images/svg/location.svg"> <?=$model->getPrettyAddress()?>
        </div>
    </div>
</a>

