<?php

/* @var $this yii\web\View */
/* @var $model common\modules\pages\models\Pages */
/* @var $languages \common\modules\language\models\Language */

$this->title = "Page:" . $model->slug;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');

?>

<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
        'languages' => $languages,
    ]) ?>

</div>
