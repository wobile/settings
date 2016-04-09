<?php

namespace wo\settings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use wo\settings\models\Settings;

class SettingsSearch extends Settings
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type', 'section', 'key', 'value'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Settings::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'section', $this->section])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value]);
        return $dataProvider;
    }
}
