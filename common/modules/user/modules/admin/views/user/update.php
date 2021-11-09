<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\service\models\Service */

$language = \Yii::$app->language;
$this->title = 'Обновить пользователя: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>