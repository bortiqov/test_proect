<?php

use common\models\University;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\post\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$status = [
    University::STATUS_INACTIVE => "Неактивный",
    University::STATUS_ACTIVE => "Активный",
];

$this->title = 'University';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::beginForm(['/university/index'], 'post'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="card shadow" style="width:100%">
            <div class="card-header">
                <div class="row items-align-center">
                    <div class="col text-right">
                        <?= Html::a(
                            Yii::t('app', 'Create University'),
                            ['create'],
                            ['class' => 'btn btn-success pull-left col-md-offset-1']
                        ) ?>
                    </div>
                </div>
            </div>
            <div class="table-responsive card-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout' => "{items}\n{pager}",
                    'tableOptions' => [
                        'class' => 'table table-sortable table-hover table-striped table-bordered',
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'headerOptions' => ['style' => 'width:50px;text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center'],
                        ],
                        [
                            'attribute' => 'id',
                            'label' => 'ID',
                            'headerOptions' => ['style' => 'width:80px;text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center']
                        ],
                        [
                            'attribute' => 'name',
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                            'value' => 'name.' . \Yii::$app->language
                        ],
                        [
                            'attribute' => 'title',
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                            'value' => 'title.' . \Yii::$app->language
                        ],
                        [
                            'attribute' => 'photo',
                            'headerOptions' => ['style' => 'width:80px;text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center'],
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->photo) {
                                    $url = $model->picture->getSrc('small');
                                    return Html::img($url, ['width' => 60]);
                                }
                                return Html::img('/avatar.png', ['width' => 60]);
                            },
                        ],
                        [
                            'attribute' => 'status',
                            'filter' => [University::STATUS_ACTIVE => "Active", University::STATUS_INACTIVE => "Inactive"],
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                            'value' => function ($model) use ($status) {
                                return $status[$model->status];
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'text-align:center;min-width:220px;max-width:220px;width:220px'],
                            'template' => '{buttons}',
                            'contentOptions' => ['style' => 'min-width:220px;max-width:220px;width:220px;text-align:center'],
                            'buttons' => [
                                'buttons' => function ($url, $model) {
                                    $update = Url::to(['/university/update', 'id' => $model->id]);
                                    $delete = Url::to(['/university/delete', 'id' => $model->id]);
                                    $code = <<<BUTTONS
                            <div>
                                <a href="{$update}" data-pjax="0" class="btn btn-primary btn-icon">
                                    <div>
                                        <i class="fa fa-edit"></i>
                                    </div>
                                </a>
                                <a href="{$delete}"  data-confirm="Are you sure?" data-method="post" class="btn btn-danger btn-icon">
                                    <div>
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </a>
                            </div>
BUTTONS;
                                    return $code;
                                }

                            ],
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
<?= Html::endForm(); ?>
