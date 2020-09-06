<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `frontend\models\Posts`.
 */
class PostsSearch extends Posts {

        /**
         * @inheritdoc
         */
        public $active;

        public function rules() {
                return [
                    [['post_id', 'sub_id', 'topic_id', 'cb', 'ub', 'status'], 'integer'],
                    [['heading', 'con_text', 'cod', 'uod', 'serach_tags', 'video_file'], 'safe'],
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
                $query = Posts::find();

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
                    'post_id' => $this->post_id,
                    'sub_id' => $this->sub_id,
                    'topic_id' => $this->topic_id,
                    'cb' => $this->cb,
                    'ub' => $this->ub,
                    'cod' => $this->cod,
                    'uod' => $this->uod,
                    'status' => $this->status,
                ]);

                $query->andFilterWhere(['like', 'heading', $this->heading])
                        ->andFilterWhere(['like', 'con_text', $this->con_text])
                        ->andFilterWhere(['like', 'serach_tags', $this->serach_tags])
                        ->andFilterWhere(['like', 'video_file', $this->video_file]);

                return $dataProvider;
        }

        public function relatedPost($id) {
                return new ActiveDataProvider([
                    'query' => \frontend\models\Posts::find()->
                            where(['topic_id' => $id])->
                            orderBy('cod DESC'),
                    'pagination' => [
                        'pageSize' => 2,
                    ],
                ]);
        }

        public function loadMyPost() {
                $query = Posts::find();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['cod' => SORT_DESC]]
                ]);
                $query->andFilterWhere(['=', 'cb', Yii::$app->user->id]);
                return $dataProvider;
        }

}
