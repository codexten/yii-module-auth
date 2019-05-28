<?php


namespace codexten\yii\modules\auth\forms;


use cheatsheet\Time;
use codexten\matrimony\MatrimonyHelper;
use codexten\yii\modules\auth\helpers\UserTokenHelper;
use codexten\yii\modules\auth\models\UserToken;
use codexten\yii\sms\Sms;
use Yii;

/**
 * Trait OtpVerificationFormTrait
 *
 * @method getPhoneNumber
 * @property string $phoneNumber
 *
 * @package codexten\yii\modules\auth\forms
 */
trait OtpVerificationFormTrait
{
    private $_otp;
    /**
     * @var Sms
     */
    public $sms;

    public function sendOtpSms(): bool
    {
        $model = new UserToken([
            'user_id' => Yii::$app->user->identity->getId(),
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
     * send phone-number-verification sms  to mobile number
     *
     * @param bool $force
     *
     * @return bool
     */
    public function sendOtp($force = false): bool
    {
        $appName = Yii::$app->name;
        $this->generateOtp();
        $otp = $this->otp;

//        return \Yii::$app->sms->send("Your {$appName} verification code is 445566", $this->phoneNumber);

//        $this->phoneNumber


//        if (($token = $this->getToken()) == false) {
//            $token = UserToken::createMobileVerificationToken(MatrimonyHelper::getMyId(),
//                Time::SECONDS_IN_A_MINUTE * 5);
//            $this->sendSms = true;
//        }
//        if ($this->sendSms && Yii::$app->request->isGet) {
//            return MatrimonyHelper::sendTransactionSmsByTemplate(Yii::$app->user->identity->mobile_no, 'mobile-phone-number-verification', [
//                'fullName' => Yii::$app->user->identity->getFullName(),
//                'code' => Yii::$app->user->identity->member->code,
//                'phone-number-verification' => $token->token,
//            ]);
//        }

        return false;
    }

    public function getOtp()
    {
        return $this->_otp;
    }

    /**
     * @return string
     */
    public function generateOtp()
    {
        $userToken = UserTokenHelper::generatePhoneNumberVerificationToken();
        $this->_otp = $userToken->code;
    }
}