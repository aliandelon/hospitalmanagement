<?php

namespace common\components;

use yii\base\Component;
use \backend\models\StudentLog;

class StudentsLoging extends Component {

        public function loging($stdid = 0, $act = NULL) {
                if ($stdid > 0 && $act !== NULL) {
                        $model = new StudentLog();
                        $model->student_id = $stdid;
                        $model->activity = $act;
                        $model->act_date = date('Y-m-d:H:i:s');
                        $model->save();
                }
        }

        public function checktokenstate($id, $params) {
                $stdDetais = \frontend\models\Students::find()->select(['multi_token'])->where(['id' => $id])->one();
                if (count($stdDetais) > 0) {
                        if ($stdDetais->multi_token === $params) {
                                return true;
                        } else {
                                return false;
                        }
                } else {
                        return false;
                }
        }

}
