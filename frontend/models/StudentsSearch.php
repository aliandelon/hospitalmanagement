<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Students;

/**
 * StudentsSearch represents the model behind the search form about `frontend\models\Students`.
 */
class StudentsSearch extends Students {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['id', 'native_place', 'native_town', 'education', 'education_cat', 'mbbs_year', 'status', 'role'], 'integer'],
                    [['first_name', 'last_name', 'password', 'user_id', 'dob', 'parent_email', 'profile_info', 'cod', 'uod'], 'safe'],
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
                $query = Students::find();

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
                    'dob' => $this->dob,
                    'native_place' => $this->native_place,
                    'native_town' => $this->native_town,
                    'education' => $this->education,
                    'education_cat' => $this->education_cat,
                    'mbbs_year' => $this->mbbs_year,
                    'status' => $this->status,
                    'cod' => $this->cod,
                    'uod' => $this->uod,
                    'role' => $this->role,
                ]);

                $query->andFilterWhere(['like', 'first_name', $this->first_name])
                        ->andFilterWhere(['like', 'last_name', $this->last_name])
                        ->andFilterWhere(['like', 'password', $this->password])
                        ->andFilterWhere(['like', 'user_id', $this->user_id])
                        ->andFilterWhere(['like', 'parent_email', $this->parent_email])
                        ->andFilterWhere(['like', 'profile_info', $this->profile_info]);
                        

                return $dataProvider;
        }

}
