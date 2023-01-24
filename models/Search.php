<?php

namespace kriptograf\menu\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * Search represents the model behind the search form about `common\models\Model`.
 *
 *
 * @package kriptograf\menu\models
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class Search extends Menu
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['id'],
                'integer',
            ],
            [
                ['name'],
                'string',
            ],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Menu::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere([
            'like',
            'name',
            $this->name,
        ]);

        return $dataProvider;
    }
}
