<?php

namespace frontend\controllers;

use common\models\Banner;
use common\models\search\UniversitySearch;
use common\models\University;

class UniversityController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $searchModel = new UniversitySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status' => University::STATUS_ACTIVE]);
        $banner = Banner::find()->andWhere(['status' => Banner::STATUS_ACTIVE])->andWhere(['type' => Banner::TYPE_UNIVERSITY])->one();

        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'banner' => $banner
            ]);
    }

    public function actionShow($slug)
    {
        $model = University::findOne(['slug' => $slug]);
        $otherUniversity = University::find()
            ->andWhere(['status' => University::STATUS_ACTIVE])
            ->andWhere(['not in','id',$model->id])
            ->orderBy('random()')->limit(3)->all();
        return $this->render('show',[
            'model' => $model,
            'otherUniversity' => $otherUniversity
        ]);
    }


}