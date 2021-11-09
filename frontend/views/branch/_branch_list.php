<?php
/**
 * @var  $model \common\models\Branch
 */
?>

<div><img class="mr-2" src="/images/svg/right.svg" alt="">
</div>
<div class="">
    <div class="text-xl text-opacity-70 text-black flex items-center mb-2"><img
            class="mr-2" src="/images/svg/location.svg" alt=""><?=$model->address[Yii::$app->language]?>
    </div>
    <a class="flex items-center w-max text-blue-600" href="tel: 55-500-55-56 "> <img
            class="mr-2" src="/images/svg/phone-dark.svg" alt=""><?=$model->phone?></a>
</div>
