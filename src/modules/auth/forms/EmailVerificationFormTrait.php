<?php


namespace codexten\yii\modules\auth\forms;


use cheatsheet\Time;
use codexten\matrimony\MatrimonyHelper;
use codexten\yii\modules\auth\helpers\UserTokenHelper;
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
trait EmailVerificationFormTrait
{
    public $otp;
    /**
     * @var Sms
     */
    public $sms;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['otp'], 'required',],
            [['otp'], 'validateOtp',],
        ];
    }

//    /**
//     * @inheritdoc
//     */
//    public function init()
//    {
//        parent::init();
//        $this->sendOtp();
//    }

    /**
     * @param string $attribute
     * @param self $model
     *
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function validateOtp($attribute)
    {
        $userToken = UserTokenHelper::getEmailVerificationTokenByCode($this->otp);

        if ($userToken === null) {
            $this->addError($attribute, 'Invalid OTP');
        } else {
            $userToken->delete();
        }
    }

    /**
     * send phone-number-verification sms  to mobile number
     *
     * @return bool
     */
    public function sendOtp(): bool
    {
        $appName = Yii::$app->name;
        $otp = $this->generateOtp();

        return Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['mailer.from'])
            ->setTo($this->getEmail())
            ->setSubject("OTP confirmations - {$appName}")
            ->setHtmlBody("Hi, <br/> Please use the following OTP <b>{$otp}</b> to verify your email id.")
            ->queue();
    }

    /**
     * @return string
     */
    public function generateOtp()
    {
        $userToken = UserTokenHelper::generateEmailVerificationToken();

        return $userToken->code;
    }
}
