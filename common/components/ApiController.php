<?php

namespace common\components;

use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\rest\IndexAction;
use yii\rest\OptionsAction;
use yii\rest\ViewAction;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class ApiController
 *
 * @package common\components
 */
abstract class ApiController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @var
     */
    public $modelClass;

    /**
     * @var
     */
    public $searchModel;

    /**
     * @var array
     */
    public $serializer = [
        'class' => 'common\components\Serializer'
    ];

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
                'languages' => [
                    'ru',
                    'en',
                    'uz',
                ],
                'formatParam' => '_f',
                'languageParam' => '_l',
            ],
            'rateLimiter' => [
                'class' => RateLimiter::class,
            ],
        ]);
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass
            ],
            'options' => [
                'class' => OptionsAction::class,
            ]
        ];
    }

    protected function findModel($id) {
        $model = $this->modelClass::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException("Entity not found");
        }

        return $model;
    }

}
