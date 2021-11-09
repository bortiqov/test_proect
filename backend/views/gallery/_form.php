<?php

use common\models\Gallery;
use common\modules\file\widgets\FileManagerModalSingle;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
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
                    <div class="form-group" style="margin: 0;">
                        <?= FileManagerModalSingle::widget([
                            'attribute' => "Gallery[file_id]",
                            'via_relation' => "file_id",
                            'model_db' => $model,
                            'form' => $form,
                            'multiple' => false,
                            'mime_type' => 'image',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="panel-heading">Status</h3>
                    <div class="panel-body">
                        <?= $form->field($model, 'status')->dropDownList([
                            Gallery::STATUS_ACTIVE => 'Active',
                            Gallery::STATUS_INACTIVE => 'Inactive'
                        ]);
                        ?>
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
