<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class SendMail extends Component {

    // common function used to send mail
    public function sendMail($to, $subject, $from, $view, $params) {
        Yii::$app->mailer->compose($view, $params)
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->send();
    }

    // for seller registration - first step
    public function sendMailCandidate($model) {
        $subject = "Welcome to InvestiGo";
        $to = $model->email;
        $from = 'info@investiGo.com';
        $view = 'welcome_seller';
        $params = ['model' => $model];
        $this->sendMail($to, $subject, $from, $view, $params);
    }
    
    
    // for sending call letter for Candidate
    public function sendMailCandidate2($profile,$job) {
        $callLetter = \common\models\JobCallLetter::find()->where(['job_id' =>$job->id])->one();
        
        $subject = $callLetter->title;
        $to = $profile->contact_email;
        $from = [\Yii::$app->params['noReplyEmail']];
        $view = 'call_letter';
        $params = ['callLetter' => $callLetter, 'profile' => $profile, 'job' => $job];
        $this->sendMail($to, $subject, $from, $view, $params);
    }
    
    
    
    
    
    
    // when user submits contact form
    public function submitContactUs($model) {
        $subject = "Beyond Holidays : Contact Us";
        $to = \yii::$app->params['adminEmail'];
        $from = $model->email;
        $view = 'user_contact_us';
        $params = ['model' => $model];
        $this->sendMail($to, $subject, $from, $view, $params);
    }

    // while new user registration, send account activation mail
    public function sendActivation($model) {
        $subject = "Beyond Holidays : Activate your Account";
        $from = \yii::$app->params['infoEmail'];
        $view = 'user_activation';
        $to = $model->email;
        $params = ['model' => $model];
        $this->sendMail($to, $subject, $from, $view, $params);
    }

    // while new user registration, send account activation mail
    public function sendWelcomeMail($model) {
        $subject = "Welcome to Beyond Holidays";
        $from = \yii::$app->params['infoEmail'];
        $view = 'welcome';
        $to = $model->email;
        $params = ['model' => $model];
        $this->sendMail($to, $subject, $from, $view, $params);
    }

    // user reset password from myaccount
    public function userPasswordReset($model) {
        $subject = "Beyond Holidays : Password Reset";
        $from = \yii::$app->params['infoEmail'];
        $view = 'password_reset';
        $to = $model->email;
        $params = ['model' => $model];
        $this->sendMail($to, $subject, $from, $view, $params);
    }

}
