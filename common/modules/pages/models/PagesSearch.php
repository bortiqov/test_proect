<?php

namespace common\modules\pages\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

use common\modules\pages\models\Pages;

/**
 * PagesSearch represents the model behind the search form of `common\modules\pages\models\Pages`.
 */
class PagesSearch extends Pages
{
    public $tag = null;
    public $topic = null;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [["id","title","subtitle","description","content","slug","template","sort","date_update","date_create","date_publish","status"],'safe']
              ];
    }

    public function init()
    {
        parent::init();
        $this->setScenario(self::SCENARIO_SEARCH);
    }
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return ArrayHelper::merge(Model::scenarios(),[
                self::SCENARIO_SEARCH => [
                    "id","title","subtitle","description","content","slug","template","sort","date_update","date_create","date_publish","status"],
        ]);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Pages::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pages.id' => $this->id,
            'pages.sort' => $this->sort,
            'pages.status' => $this->status,
        ]);


        /**
         * date
         */
        if(strlen($this->date_create) > 0):
            $date_create = explode(' - ',$this->date_create);
            $date_create_start = strtotime($date_create[0]);
            $date_create_end = strtotime($date_create[1]);
            $query->andFilterWhere(['between', 'pages.date_create', $date_create_start, $date_create_end ]);
        endif;

        if(strlen($this->date_update) > 0):
            $date_update = explode(' - ',$this->date_update);
            $date_update_start = strtotime($date_update[0]);
            $date_update_end = strtotime($date_update[1]);
            $query->andFilterWhere(['between', 'pages.date_create', $date_update_start, $date_update_end ]);
        endif;

        if(strlen($this->date_publish) > 0):
            $date_publish = explode(' - ',$this->date_publish);
            $date_publish_start = strtotime($date_publish[0]);
            $date_publish_end = strtotime($date_publish[1]);
            $query->andFilterWhere(['between', 'pages.date_create', $date_publish_start, $date_publish_end ]);
        endif;

        /**
         * date end
         */
        if ($this->title) {
            $query->andWhere("(lower(page.title->>'ru') ILIKE '%$this->title%') or (lower(page.title->>'en') ILIKE '%$this->title%') or (lower(page.title->>'uz') ILIKE '%$this->title%')");
        }
        $query->andFilterWhere(['like', 'pages.subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'pages.description', $this->description])
            ->andFilterWhere(['like', 'pages.content', $this->content])
            ->andFilterWhere(['like', 'page.slug', $this->slug])
            ->andFilterWhere(['like', 'pages.template', $this->template]);

        return $dataProvider;
    }
}
