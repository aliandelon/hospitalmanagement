<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HospitalClinicDetails;

/**
 * HospitalClinicDetailsSearch represents the model behind the search form about `common\models\HospitalClinicDetails`.
 */
class HospitalClinicDetailsSearch extends HospitalClinicDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type', 'have_diagnostic_center', 'master_hospital_id', 'same_as_hospital_details_flag', 'pincode', 'status', 'package_id', 'created_by', 'commision_type', 'commision'], 'integer'],
            [['name', 'phone_number', 'email', 'address', 'street1', 'street2', 'city', 'area', 'latitude', 'longitude'], 'safe'],
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
        $query = HospitalClinicDetails::find();

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
            'user_id' => $this->user_id,
            'type' => $this->type,
            'have_diagnostic_center' => $this->have_diagnostic_center,
            'master_hospital_id' => $this->master_hospital_id,
            'same_as_hospital_details_flag' => $this->same_as_hospital_details_flag,
            'pincode' => $this->pincode,
            'status' => $this->status,
            'package_id' => $this->package_id,
            'created_by' => $this->created_by,
            'commision_type' => $this->commision_type,
            'commision' => $this->commision,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'street1', $this->street1])
            ->andFilterWhere(['like', 'street2', $this->street2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['!=', 'status',1]);

        return $dataProvider;
    }
}
