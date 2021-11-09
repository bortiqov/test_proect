<?php

namespace frontend\controllers;

use common\models\Banner;
use common\modules\post\models\Post;
use common\modules\post\models\search\PostSearch;

class PostController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['<','published_at',time()])->andWhere(['status' => Post::STATUS_ACTIVE]);
        $banner = Banner::find()->andWhere(['status' => Banner::STATUS_ACTIVE])->andWhere(['type' => Banner::TYPE_BLOG])->one();

        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'banner' => $banner
        ]);
    }

    public function actionShow($slug)
    {
        $model = Post::findOne(['slug' => $slug]);
        $newModel = Post::find()->orderBy(['created_at' => SORT_DESC])->limit(3)->all();


        return $this->render('show',[
            'model' => $model,
            'newModel' => $newModel,

        ]);
    }


}