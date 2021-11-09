<?php

use common\models\Banner;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$status = [
    Banner::STATUS_INACTIVE => "Неактивный",
    Banner::STATUS_ACTIVE => "Активный",
];
$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::beginForm(['/branch/index'], 'post'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="card shadow" style="width:100%">
            <div class="card-header">
                <div class="row items-align-center">
                    <div class="col text-right">
                        <?= Html::a(
                            Yii::t('app', 'Create Branch'),
                            ['create'],
                            ['class' => 'btn btn-success pull-left col-md-offset-1']
                        ) ?>
                    </div>
                </div>
            </div>
            <div class="table-responsive card-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
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
                            'attribute' => 'title',
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                            'value' => 'title.' . \Yii::$app->language
                        ],
                        [
                            'attribute' => 'file_id',
                            'label' =>'Image',
                            'headerOptions' => ['style' => 'width:80px;text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center'],
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->file_id) {
                                    $url = $model->file->getSrc('small');
                                    return Html::img($url, ['width' => 80]);
                                }
                                return Html::img('/avatar.png', ['width' => 60]);
                            },
                        ],
                        [
                            'attribute' => 'status',
                            'filter' => [Banner::STATUS_ACTIVE => "Active",Banner::STATUS_INACTIVE => "Inactive"],
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                            'value' => function ($model) use ($status) {
                                return $status[$model->status];
                            }
                        ],
                        [
                            'attribute' => 'type',
//                            'filter' => [Banner::STATUS_ACTIVE => "Active",Banner::STATUS_INACTIVE => "Inactive"],
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                            'value' => function ($model) {
                                return $model->getType();
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'text-align:center;min-width:220px;max-width:220px;width:220px'],
                            'template' => '{buttons}',
                            'contentOptions' => ['style' => 'min-width:220px;max-width:220px;width:220px;text-align:center'],
                            'buttons' => [
                                'buttons' => function ($url, $model) {
                                    $update = Url::to(['/banner/update', 'id' => $model->id]);
                                    $delete = Url::to(['/banner/delete', 'id' => $model->id]);
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

