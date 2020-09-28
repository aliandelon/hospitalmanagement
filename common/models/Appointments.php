<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appointments".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property integer $investigation_id
 * @property integer $slot_day_time_mapping_id
 * @property integer $hospital_clinic_id
 * @property string $app_date
 * @property string $app_time
 * @property integer $appointment_type
 */
class Appointments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appointments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'investigation_id', 'slot_day_time_mapping_id', 'hospital_clinic_id', 'app_date', 'app_time'], 'required'],
            [['patient_id', 'doctor_id', 'investigation_id', 'slot_day_time_mapping_id', 'hospital_clinic_id', 'appointment_type'], 'integer'],
            [['app_date'], 'safe'],
            [['app_time'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'patient_id' => 'Patient ID',
            'doctor_id' => 'Doctor ID',
            'investigation_id' => 'Investigation ID',
            'slot_day_time_mapping_id' => 'Slot Day Time Mapping ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            // 'app_date' => 'App Date',
            // 'app_time' => 'App Time',
            // 'appointment_type' => 'Appointment Type',
        ];
    }
}
