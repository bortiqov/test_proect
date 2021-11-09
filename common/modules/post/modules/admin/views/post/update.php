<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\post\models\Post */

$this->title = Yii::t('app', 'Update Post: {name}', [
    'name' => $model->title[Yii::$app->language],
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="post-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
