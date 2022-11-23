<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TemplateProperties;

/**
 * TemplatePropertiesSearch represents the model behind the search form of `app\models\TemplateProperties`.
 */
class TemplatePropertiesSearch extends TemplateProperties
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'property', 'name', 'valueType', 'options'], 'safe'],
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
        $query = TemplateProperties::find();

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
        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'property', $this->property])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'valueType', $this->valueType])
            ->andFilterWhere(['like', 'options', $this->options]);

        return $dataProvider;
    }
}
