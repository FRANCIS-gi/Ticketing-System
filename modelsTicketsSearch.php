<?php

namespace app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tickets;

/**
 * modelsTicketsSearch represents the model behind the search form of `app\models\Tickets`.
 */
class modelsTicketsSearch extends Tickets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id', 'due_date'], 'integer'],
            [['company_name', 'ticket_name', 'description', 'priority', 'status', 'created_by', 'assigned_to'], 'safe'],
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
        $query = Tickets::find();

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
            'ticket_id' => $this->ticket_id,
            'due_date' => $this->due_date,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'ticket_name', $this->ticket_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'assigned_to', $this->assigned_to]);

        return $dataProvider;
    }
}
