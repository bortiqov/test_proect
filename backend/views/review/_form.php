<?php

use common\models\Review;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="">

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <?= $form->field($model, 'first_name')->textInput() ?>
                        <?= $form->field($model, 'last_name')->textInput() ?>
                        <?= $form->field($model, 'message')->textarea() ?>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <?= $form->field($model, 'status')->dropDownList([
                            Review::STATUS_ACTIVE => 'Active',
                            Review::STATUS_INACTIVE => 'Inactive'
                        ]);
                        ?>

                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php ActiveForm::end(); ?>
