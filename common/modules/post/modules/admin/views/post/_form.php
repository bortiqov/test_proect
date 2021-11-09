<?php

use common\modules\file\widgets\FileManagerModal;
use common\modules\file\widgets\FileManagerModalSingle;
use common\modules\post\models\Post;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\post\models\post */
/* @var $form yii\widgets\ActiveForm */
$languages = \common\modules\language\models\Language::find()->active()->all();
//$this->registerJs()
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
                                    <?= $form->field($model, 'anons[' . $language->code . ']')->textarea(['rows' => 3]) ?>
                                    <?= $form->field($model, 'description[' . $language->code . ']')->widget(CKEditor::class) ?>
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
                    <h3 class="panel-heading">Main Photo</h3>
                    <div class="panel-body">
                        <div class="form-group" style="margin: 0;">
                            <?= FileManagerModalSingle::widget([
                                'attribute' => "Post[photo]",
                                'via_relation' => "photo",
                                'model_db' => $model,
                                'form' => $form,
                                'multiple' => false,
                                'mime_type' => 'image',
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">

                    <?= $form->field($model, 'status')->dropDownList([
                        Post::STATUS_ACTIVE => 'Active',
                        Post::STATUS_INACTIVE => 'Inactive'
                    ]);
                    ?>

                    <?= $form->field($model, 'published_at', [
                        'options' => [
                            'class' => 'form-group',

                        ],
                        'template' => "{label}{input}",
                    ])
                        ->widget(DatePicker::className(), [
                            'options' => [
                                'class' => 'form-control',
                                "placeholder" => "Select date",
                                "value" => date("", $model->isNewRecord ? time() : $model->published_at),
                            ],

                        ], false); ?>

                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
