<?php

use common\modules\user\models\User;
use kartik\export\ExportMenu;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
$status = [
    User::STATUS_INACTIVE => "Неактивный",
    User::STATUS_ACTIVE => "Активный",
]
?>

<div class="container-fluid">
    <div class="row">
        <div class="card shadow" style="width: 100%">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <?php /* ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'layout' => "{items}\n{pager}",
                            'options' => [
                                'icon' => '<i class="fa fa-upload"></i>'
                            ],
                            'fontAwesome' => true,
                            'tableOptions' => [
                                'class' => 'table table-sortable table-hover table-striped table-bordered',
                            ],
                            'columns' => [
                                'id',
                                'first_name',
                                'last_name',
                                'email',
                                [
                                    'attribute' => 'status',
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        $statuses = [\common\modules\user\models\User::STATUS_ACTIVE => 'Актив', \common\modules\user\models\User::STATUS_INACTIVE => 'Инактив', \common\modules\user\models\User::STATUS_DELETED => 'Удален'];
                                        return $statuses[$model->status];
                                    }
                                ],
                            ],
                        ]); */ ?>
                        <?= Html::beginForm(['/user/user/index'], 'post'); ?>
                        <?= Html::submitButton(__("Delete"), ['class' => 'btn btn-danger', 'data-confirm' => "Are you sure?"]); ?>
                        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success pull-right']) ?>
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
                            'attribute' => 'first_name',
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                        ],
                        [
                            'attribute' => 'last_name',
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                        ],
                        [
                            'attribute' => 'email',
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => '']
                        ],
                        [
                            'attribute' => 'avatar',
                            'headerOptions' => ['style' => 'width:80px;text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center'],
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->avatar) {
                                    $url = $model->avatar->getSrc('small');
                                    return Html::img($url, ['width' => 60]);
                                }
                                return Html::img('/avatar.png', ['width' => 60]);
                            },
                        ],

                        [
                            'attribute' => 'status',
                            'filter' => [User::STATUS_ACTIVE => "Active", User::STATUS_INACTIVE => "Inactive"],
                            'headerOptions' => ['style' => ''],
                            'contentOptions' => ['style' => ''],
                            'value' => function ($model) use ($status) {
                                return $status[$model->status];
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'text-align:center;min-width:160px;max-width:160px;width:150px'],
                            'template' => '{buttons}',
                            'contentOptions' => ['style' => 'min-width:160px;max-width:150px;width:160px;text-align:center'],
                            'buttons' => [
                                'buttons' => function ($url, $model) {
                                    $update = Url::to(['/user/user/update', 'id' => $model->id]);
                                    $delete = Url::to(['/user/user/delete', 'id' => $model->id]);
                                    $code = <<<BUTTONS
                            <div>
                                <a href="{$update}" data-pjax="0" class="btn btn-info btn-icon">
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
