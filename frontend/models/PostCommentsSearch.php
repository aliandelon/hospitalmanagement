<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PostComments;

/**
 * PostCommentsSearch represents the model behind the search form about `frontend\models\PostComments`.
 */
class PostCommentsSearch extends PostComments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_id', 'cb', 'status', 'post_id'], 'integer'],
            [['comment', 'cod', 'field'], 'safe'],
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
        $query = PostComments::find();

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
            'comment_id' => $this->comment_id,
            'cb' => $this->cb,
            'status' => $this->status,
            'cod' => $this->cod,
            'post_id' => $this->post_id,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'field', $this->field]);

        return $dataProvider;
    }
}
