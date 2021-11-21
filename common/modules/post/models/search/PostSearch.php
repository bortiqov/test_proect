<?php

namespace common\modules\post\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\post\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\modules\post\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author', 'type', 'created_at', 'updated_at', 'published_at', 'top', 'viewed', 'status', 'short_link'], 'integer'],
            [['title', 'description', 'slug', 'photo', 'anons'], 'safe'],
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
        $query = Post::find();

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
            'id' => $this->id,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'published_at' => $this->published_at,
            'top' => $this->top,
            'viewed' => $this->viewed,
            'status' => $this->status,
            'short_link' => $this->short_link,
        ]);

        $query->andWhere(['<','published_at',time()]);
        if ($this->title) {
            $query->andFilterWhere(['like', 'title', $this->title]);
        }

        if ($this->description) {
            $query->andFilterWhere(['like', 'description', $this->description]);

        }

        if ($this->anons) {
            $query->andFilterWhere(['like', 'anons', $this->anons]);
        }

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'photo', $this->photo]);
        return $dataProvider;
    }
}
