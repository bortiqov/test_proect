<?php

namespace frontend\controllers;

use common\models\Banner;
use common\models\Phone;
use common\models\Review;
use common\models\search\UniversitySearch;
use common\models\University;
use common\modules\post\models\Post;
use common\modules\post\models\search\PostSearch;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UniversitySearch();
        $universityProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $universityProvider->query->andWhere(['status' => University::STATUS_ACTIVE])->limit(9) ;

        $reviews = Review::find()->andWhere(['status' => Review::STATUS_ACTIVE])->all();

        $postSearch = new PostSearch();
        $postProvider = $postSearch->search(Yii::$app->request->queryParams);
        $postProvider->query->andWhere(['<','published_at',time()])->andWhere(['status' => Post::STATUS_ACTIVE]);

        $banners = Banner::find()->andWhere(['status' => Banner::STATUS_ACTIVE])->andWhere(['type' => Banner::TYPE_MAIN])->all();


        $phone = new Phone();
        if ($phone->load(\Yii::$app->request->post()) && $phone->save())
        {
            return $this->redirect(\Yii::$app->request->referrer);
        }

        return $this->render('index',[
            'universityProvider' => $universityProvider,
            'postProvider' => $postProvider,
            'reviews' => $reviews,
            'banners' => $banners,
            'phone' => $phone
        ]);
    }


}
