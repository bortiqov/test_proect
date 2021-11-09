<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\University;

/**
 * UniversitySearch represents the model behind the search form of `common\models\University`.
 */
class UniversitySearch extends University
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'top', 'viewed', 'status', 'short_link'], 'integer'],
            [['title', 'name', 'description', 'slug', 'photo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = University::find();

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
            'top' => $this->top,
            'status' => $this->status,
            'short_link' => $this->short_link,
        ]);

        $query->andFilterWhere(['ilike', 'slug', $this->slug])
            ->andFilterWhere(['ilike', 'photo', $this->photo]);

        if ($this->title) {
            $query->andWhere("(lower(university.title->>'ru') ILIKE '%$this->title%') or (lower(university.title->>'en') ILIKE '%$this->title%') or (lower(university.title->>'uz') ILIKE '%$this->title%')");
        }

        if ($this->description) {
            $query->andWhere("(lower(university.description->>'ru') ILIKE '%$this->description%') or (lower(university.description->>'en') ILIKE '%$this->description%') or (lower(university.description->>'uz') ILIKE '%$this->description%')");

        }

        if ($this->name) {
            $query->andWhere("(lower(university.name->>'ru') ILIKE '%$this->name%') or (lower(university.name->>'en') ILIKE '%$this->name%') or (lower(university.name->>'uz') ILIKE '%$this->name%')");
        }

        return $dataProvider;
    }
}
