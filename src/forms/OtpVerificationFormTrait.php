<?php


namespace codexten\yii\modules\auth\forms;


use cheatsheet\Time;
use codexten\matrimony\MatrimonyHelper;
use codexten\yii\modules\auth\models\UserToken;

/**
 * Trait OtpVerificationFormTrait
 *
 * @method getPhoneNumber
 * @property string $mobileNumber
 *
 * @package codexten\yii\modules\auth\forms
 */
trait OtpVerificationFormTrait
{
    public $otp;

    public function sendOtpSms(): bool
    {
        $model = new UserToken([
            'user_id' => \Yii::$app->user->identity->getId(),
            'type' => UserToken::TYPE_OTP_VERIFICATION,
        ]);

        return $model->code;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->sendOtp();
    }

    /**
     * send otp sms  to mobile number
     *
     * @return bool
     */
    public function sendOtp(): bool
    {
        $phoneNumber = $this->getPhoneNumber();


//        if (($token = $this->getToken()) == false) {
//            $token = UserToken::createMobileVerificationToken(MatrimonyHelper::getMyId(),
//                Time::SECONDS_IN_A_MINUTE * 5);
//            $this->sendSms = true;
//        }
//        if ($this->sendSms && Yii::$app->request->isGet) {
//            return MatrimonyHelper::sendTransactionSmsByTemplate(Yii::$app->user->identity->mobile_no, 'mobile-otp', [
//                'fullName' => Yii::$app->user->identity->getFullName(),
//                'code' => Yii::$app->user->identity->member->code,
//                'otp' => $token->token,
//            ]);
//        }

        return false;
    }
}