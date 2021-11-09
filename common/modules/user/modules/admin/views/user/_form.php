<?php

use common\modules\file\widgets\FileManagerModal;
use common\modules\file\widgets\FileManagerModalSingle;
use common\modules\user\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */

$form_name = $model->formName();

$current_language = \Yii::$app->language;

?>

<div class="">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="row ">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <?= $form->field($model, 'first_name')->textInput() ?>
                        <?= $form->field($model, 'last_name')->textInput() ?>
                        <?= $form->field($model, 'email')->textInput() ?>
                        <?= $form->field($model, 'password')->textInput(['type' => 'password']) ?>
                        <?= $form->field($model, 'password_confirm')->textInput(['type' => 'password']) ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card shadow mt-4">
                <div class="panel-wrapper">
                    <div class="card-body">
                        <div>
                            <label style='<?= $model->getErrors('filesdata') ? "color: red;" : "" ?>'
                                   class="poster-label control-label"
                                   for="university-filesdata"><?= __("Photos") ?></label>
                            <?= FileManagerModal::widget([
                                'model_db' => $model,
                                'form' => $form,
                                'attribute' => 'User[filesdata]',
                                'id' => 'university_filesdata',
                                'relation_name' => 'avatar',
                                'via_relation_name' => 'userAvatar',
                                'multiple' => false,
                                'mime_type' => 'image'
                            ]); ?>
                        </div>
                        <?= $form->field($model, 'role')->dropDownList([User::ROLE_ADMIN => 'Admin', User::ROLE_EDITOR => 'User']) ?>

                        <?= $form->field($model, 'status')->dropDownList([User::STATUS_ACTIVE => 'Активный',
                            User::STATUS_INACTIVE => 'Неактивный'], ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]) ?>
                        <?php if (Yii::$app->controller->action->id == "update") { ?>
                            <?= Html::submitButton(__('Update'), ['class' => 'btn btn-success']) ?>
                        <?php } ?>
                        <?php if (Yii::$app->controller->action->id == "create") { ?>
                            <?= Html::submitButton(__('Save'), ['class' => 'btn btn-success']) ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
