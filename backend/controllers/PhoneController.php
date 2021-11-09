<?php

namespace backend\controllers;

use common\models\Phone;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PhoneController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $query = Phone::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index',['dataProvider' => $dataProvider]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Phone::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}