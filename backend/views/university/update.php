<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\University */

$this->title = Yii::t('app', 'Update University: {name}', [
    'name' => $model->name[Yii::$app->language],
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'University'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="post-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
