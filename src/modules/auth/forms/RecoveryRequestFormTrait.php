<?php


namespace codexten\yii\modules\auth\forms;

use codexten\yii\components\Mailer;
use codexten\yii\modules\auth\helpers\UserTokenHelper;
use codexten\yii\modules\auth\models\User;

/**
 * Trait RecoveryRequestFormTrait
 *
 * @property User $user
 * @property string $recoveryUrl
 * @property string $token
 *
 * @package codexten\yii\modules\auth\forms
 */
trait RecoveryRequestFormTrait
{
    private $_token;

    public function sendRecoveryMessage(): bool
    {
        return (new Mailer([
            'to' => $this->user->email,
            'templatePath' => '@moduleAuth/mail',
            'code' => 'password-recovery',
            'subject' => 'Reset Your password',
            'params' => [
                'recoveryUrl' => $this->recoveryUrl,
                'appName' => \Yii::$app->name,
            ],
        ]))->queue();
    }

    public function getToken(): string
    {
        if ($this->_token == null) {
            $token = UserTokenHelper::generatePasswordRecoveryToken($this->user->id);
            $this->_token = $token->code;
        }

        return $this->_token;
    }

    public function getRecoveryUrl(): string
    {
        return \Yii::$app->urlManager->createAbsoluteUrl([
            '/auth/recovery/reset',
            'id' => $this->user->id,
            'code' => $this->token,
        ]);
    }
}
