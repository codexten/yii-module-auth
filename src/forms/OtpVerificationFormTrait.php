<?php


namespace codexten\yii\modules\auth\forms;


use cheatsheet\Time;
use codexten\matrimony\MatrimonyHelper;
use codexten\yii\modules\auth\models\UserToken;

trait OtpVerificationFormTrait
{
    public $otp;

    public function sendOtpSms()
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

    public function sendOtp()
    {
        if (($token = $this->getToken()) == false) {
            $token = \enyii\common\models\UserToken::createMobileVerificationToken(MatrimonyHelper::getMyId(), Time::SECONDS_IN_A_MINUTE * 5);
            $this->sendSms = true;
        }
        if ($this->sendSms && Yii::$app->request->isGet) {
            return MatrimonyHelper::sendTransactionSmsByTemplate(Yii::$app->user->identity->mobile_no, 'mobile-otp', [
                'fullName' => Yii::$app->user->identity->getFullName(),
                'code' => Yii::$app->user->identity->member->code,
                'otp' => $token->token,
            ]);
        }
    }
}