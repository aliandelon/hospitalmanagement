<?php

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\Options;
/**
 * This is the model class for table "testpaper".
 *
 * @property integer $test_id
 * @property string $test_name
 * @property integer $chapter_id
 * @property integer $cb
 * @property integer $ub
 * @property string $cod
 * @property string $uod
 * @property integer $status
 * @property string $field
 * @property string $field2
 */
class Testpapers extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
	public $chpid;
	
        public static function tableName() {
                return 'testpaper';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['chapter_id', 'cb'], 'required'],
                    [['chapter_id', 'cb', 'ub', 'status'], 'integer'],
                    [['cod', 'uod'], 'safe'],
                    [['test_name'], 'string', 'max' => 150],
                    [['field', 'field2'], 'string', 'max' => 45],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'test_id' => 'Test ID',
                    'test_name' => 'Test Name',
                    'chapter_id' => 'Chapter ID',
                    'cb' => 'Cb',
                    'ub' => 'Ub',
                    'cod' => 'Cod',
                    'uod' => 'Uod',
                    'status' => 'Status',
                    'field' => 'Field',
                    'field2' => 'Field2',
                ];
        }

        public function getChapter() {
                return $this->hasOne(\backend\models\Chapters::className(), ['chapter_id' => 'chapter_id']);
        }
        public function loadAnswer($id=0){
        	return  Options::find()->select(['option_id','options'])->where(['question_id'=>$id,'status'=>1])->all();
        
        }
        public function loadTestQuestions(){
        	 
        	$query = new yii\db\Query();
        	$dataProvider = new ActiveDataProvider([
        			'query' => $query,
        			'pagination' => [
        					'pageSize' => 1,
        			],
        	]);
        	$query->select(['id', 'test_name', 'questions.*'])
        	->from('testpaper')
        	->leftJoin('questions', 'testpaper.id=questions.test_id ')
        	->where(['chapter_id' => $this->chpid]);
        	 
        	return $dataProvider;
        	 
        }

}
