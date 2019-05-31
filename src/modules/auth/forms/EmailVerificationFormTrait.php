<?php


namespace codexten\yii\modules\auth\forms;


use cheatsheet\Time;
use codexten\matrimony\MatrimonyHelper;
use codexten\yii\modules\auth\helpers\UserTokenHelper;
use codexten\yii\modules\auth\models\UserToken;
use codexten\yii\sms\Sms;
use phpDocumentor\Reflection\Types\Static_;
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

//        $otp = $this->otp;

//        return \Yii::$app->sms->send("Your {$appName} verification code is {$otp}", $this->phoneNumber);

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

    /**
     * @return string
     */
    public function generateOtp()
    {
        $userToken = UserTokenHelper::generateEmailVerificationToken();

        return $userToken->code;
    }
}
