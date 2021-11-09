<?php

namespace frontend\controllers;

use common\models\Banner;
use common\models\Branch;
use common\models\search\BranchSearch;

class BranchController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $searchModel = new BranchSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        $banner = Banner::find()->andWhere(['status' => Banner::STATUS_ACTIVE])->andWhere(['type' => Banner::TYPE_FILIAL])->one();

        $dataProvider->query->andWhere(['status' => Branch::STATUS_ACTIVE]);

        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'banner' => $banner
        ]);
    }

}