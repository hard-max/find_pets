<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Animal;

/**
 * AnimalSearch represents the model behind the search form about `app\models\Animal`.
 */
class AnimalSearch extends Animal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'type_id', 'location_id', 'user_id', 'status'], 'integer'],
            [['date', 'gender', 'age', 'height', 'name_animal', 'description', 'date_created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Animal::find();

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
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'location_id' => $this->location_id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'date_created' => $this->date_created,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'height', $this->height])
            ->andFilterWhere(['like', 'name_animal', $this->name_animal])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
