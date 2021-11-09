<?php

namespace frontend\controllers;


use common\models\Phone;
use common\models\Review;
use common\modules\pages\models\Pages;
use common\modules\user\models\User;

class PageController extends \yii\web\Controller
{

    public function actionIndex($slug)
    {
        $model =  Pages::findOne(['slug' => $slug]);
        $users = User::find()->andWhere(['role' => User::ROLE_EDITOR])->andWhere(['status' => User::STATUS_ACTIVE])->all();
        $phone = new Phone();
        if ($phone->load(\Yii::$app->request->post()) && $phone->save())
        {
            return $this->redirect(\Yii::$app->request->referrer);
        }
        return $this->render('about',[
            'users' => $users,
            'model' => $model,
            'phone' => $phone
            ]);
    }
}