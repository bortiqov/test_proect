<?php

use common\modules\file\widgets\FileManagerModalSingle;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */

$languages = \common\modules\language\models\Language::find()->active()->all();

?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<div class="">

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <ul class="nav customtab nav-tabs">
                        <?php
                        /**
                         * @var $languages
                         */
                        foreach ($languages as $key => $language): ?>
                            <li>
                                <a class="nav-link <?= $key != 0 ?: 'active' ?>" href="#language-<?= $language->code ?>"
                                   data-toggle="tab"><?= mb_strtoupper($language->name) ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content" style="margin: 0">
                        <?php
                        /**
                         * @var $languages
                         */
                        foreach ($languages as $key => $language): ?>
                            <div class="tab-pane <?= $key != 0 ?: 'active in' ?>" id="language-<?= $language->code ?>">
                                <div class="pt-4">
                                    <?= $form->field($model, 'title[' . $language->code . ']')->textInput() ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group" style="margin: 0;">
                        <?= FileManagerModalSingle::widget([
                            'attribute' => "Banner[file_id]",
                            'via_relation' => "file_id",
                            'model_db' => $model,
                            'form' => $form,
                            'multiple' => false,
                            'mime_type' => 'image',
                        ]); ?>
                    </div>

                    <?= $form->field($model, 'type')->dropDownList([
                        \common\models\Banner::getTypes()
                    ]);?>
                    <?= $form->field($model, 'status')->dropDownList([
                        \common\models\Banner::STATUS_ACTIVE => 'Active',
                        \common\models\Banner::STATUS_INACTIVE => 'Inactive'
                    ]);
                    ?>

                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
