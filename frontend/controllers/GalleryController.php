<?php

namespace frontend\controllers;

use common\models\Banner;
use common\models\Gallery;
use common\models\search\GallerySearch;
use common\modules\settings\models\Settings;

class GalleryController extends \yii\web\Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status' => Gallery::STATUS_ACTIVE]);

        $banner = Banner::find()->andWhere(['status' => Banner::STATUS_ACTIVE])->andWhere(['type' => Banner::TYPE_GALLERY])->one();

        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'banner' => $banner
            ]);
    }

}