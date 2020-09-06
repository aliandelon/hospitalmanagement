<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Students;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model {

        public $user_id;

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    ['user_id', 'trim'],
                    ['user_id', 'required'],
                    ['user_id', 'email'],
                    ['user_id', 'exist',
                        'targetClass' => '\frontend\models\Students',
                        'filter' => ['status' => Students::STATUS_ACTIVE],
                        'message' => 'There is no user with such email.'
                    ],
                ];
        }

        /**
         * Sends an email with a link, for resetting the password.
         *
         * @return boolean whether the email was send
         */
        public function sendEmail() {
                /* @var $user User */
                $user = Students::findOne([
                            'status' => Students::STATUS_ACTIVE,
                            'user_id' => $this->user_id,
                ]);
                
             

                if (!$user) {
                        return false;
                }

                if (!Students::isPasswordResetTokenValid($user->password_reset_token)) {
                        $user->generatePasswordResetToken();
                        if (!$user->save()) {
                                return false;
                        }
                }
                  
                return Yii::$app
                                ->mailer
                                ->compose(
                                        ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user]
                                )
                                ->setFrom([Yii::$app->params['supportEmail'] => ' sujan@intersmart.in'])
                                ->setTo($this->user_id)
                                ->setSubject('Password reset for mastermbbs ' )
                                ->send();
                                
                               
                             
        }
          

}
