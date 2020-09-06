<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Forms;

/**
 * FormsSearch represents the model behind the search form about `frontend\models\Forms`.
 */
class FormsSearch extends Forms {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['id', 'cb', 'status', 'topic_id'], 'integer'],
                    [['title', 'content', 'cod'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function scenarios() {
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
        public function search($params) {
                $query = Forms::find();

                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['cod' => SORT_DESC]]
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
                    'cb' => $this->cb,
                    'status' => $this->status,
                    'cod' => $this->cod,
                    'topic_id' => $this->topic_id,
                ]);

                $query->andFilterWhere(['like', 'title', $this->title])
                        ->andFilterWhere(['like', 'content', $this->content]);

                return $dataProvider;
        }

        public function loadMyQuestions() {
                $query = Forms::find();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['cod' => SORT_DESC]]
                ]);
                $query->andFilterWhere(['=', 'cb', Yii::$app->user->id]);
                return $dataProvider;
        }

}
