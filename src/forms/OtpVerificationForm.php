<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 7/3/19
 * Time: 4:47 PM
 */

namespace codexten\yii\modules\auth\forms;


use codexten\yii\modules\auth\models\UserToken;
use codexten\yii\web\widgets\settings\Form;

abstract class OtpVerificationForm extends Form
{
    public $otp;


    public function save()
    {

    }

    abstract public function getMobileNumber();

    abstract public function verify();
    
    public function sendOtpSms()
    {
        $model = new UserToken([
            'user_id' => \Yii::$app->user->identity->getId(),
            'type' => UserToken::TYPE_OTP_VERIFICATION,
        ]);

        return $model->code;
    }
}