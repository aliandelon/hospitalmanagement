<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DoctorsDetails;

/**
 * DoctorsDetailsSearch represents the model behind the search form about `common\models\DoctorsDetails`.
 */
class DoctorsDetailsSearch extends DoctorsDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hospital_clinic_id', 'experience', 'specialty_id', 'status'], 'integer'],
            [['name', 'email', 'phone', 'gender', 'registration_no', 'profile_image', 'qualifications', 'address', 'created_on'], 'safe'],
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
        $query = DoctorsDetails::find();

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
            'hospital_clinic_id' => $this->hospital_clinic_id,
            'experience' => $this->experience,
            'specialty_id' => $this->specialty_id,
            'status' => $this->status,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'profile_image', $this->profile_image])
            ->andFilterWhere(['like', 'qualifications', $this->qualifications])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
