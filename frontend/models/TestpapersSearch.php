<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Testpapers;
use backend\models\Answers;
use backend\models\OptionsSearch;
use backend\models\QuestionSearch;
use backend\models\Question;

/**
 * TestpapersSearch represents the model behind the search form about `frontend\models\Testpapers`.
 */
class TestpapersSearch extends Testpapers
{
    /**
     * @inheritdoc
     */
	
    public function rules()
    {
        return [
            [['test_id', 'chapter_id', 'cb', 'ub', 'status'], 'integer'],
            [['test_name', 'cod', 'uod', 'field', 'field2'], 'safe'],
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
        $query = Testpapers::find();

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
            'test_id' => $this->test_id,
            'chapter_id' => $this->chapter_id,
            'cb' => $this->cb,
            'ub' => $this->ub,
            'cod' => $this->cod,
            'uod' => $this->uod,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'test_name', $this->test_name])
            ->andFilterWhere(['like', 'field', $this->field])
            ->andFilterWhere(['like', 'field2', $this->field2]);

        return $dataProvider;
    }
    
    
    
    
}
