<?php

namespace common\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\user\models\UserAction;

/**
 * UserActionSearch represents the model behind the search form of `common\modules\user\models\UserAction`.
 */
class UserActionSearch extends UserAction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'user_id', 'exhibition_id', 'activities'], 'integer'],
            [['action', 'controller', 'uri', 'cookies', 'get_params', 'post_params', 'user_agent', 'referer', 'user_ip'], 'safe'],
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
        $query = UserAction::find();

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
            'created_at' => $this->created_at,
            'user_id' => $this->user_id,
            'exhibition_id' => $this->exhibition_id,
        ]);

        $query->andFilterWhere(['ilike', 'action', $this->action])
            ->andFilterWhere(['ilike', 'controller', $this->controller])
            ->andFilterWhere(['ilike', 'uri', $this->uri])
            ->andFilterWhere(['ilike', 'cookies', $this->cookies])
            ->andFilterWhere(['ilike', 'get_params', $this->get_params])
            ->andFilterWhere(['ilike', 'post_params', $this->post_params])
            ->andFilterWhere(['ilike', 'user_agent', $this->user_agent])
            ->andFilterWhere(['ilike', 'referer', $this->referer])
            ->andFilterWhere(['ilike', 'user_ip', $this->user_ip]);

        return $dataProvider;
    }
}
