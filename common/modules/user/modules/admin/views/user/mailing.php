<?php

use common\modules\file\widgets\FileManagerModalSingle;
use common\modules\user\models\User;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */

$current_language = \Yii::$app->language;

?>

<div class="container-fluid">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-wrapper">
                    <div class="panel-body">
                        <?= $form->field($model, 'subject')->textInput() ?>
                        <?= $form->field($model, 'message')->widget(CKEditor::className(), [
                            'options' => ['rows' => 12],
                            'clientOptions' => [
                                'height' => 400,
                                'allowedContent' => true
                            ],
                            'preset' => 'full',
                        ])->label(__("Тўлиқ матнни киритнг")) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-wrapper">
                    <div class="panel-body">
                        <?= $form->field($model, 'type')->dropDownList([
                            \common\modules\user\modules\admin\forms\MailingForm::TYPE_ALL => __("Send to all"),
                            \common\modules\user\modules\admin\forms\MailingForm::TYPLE_PER => __("Send to per email")
                        ]) ?>
                        <?= $form->field($model, 'email')->textInput() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= Html::submitButton(__('Send'), ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
