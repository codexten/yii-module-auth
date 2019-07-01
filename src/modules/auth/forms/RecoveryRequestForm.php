<?php

namespace codexten\yii\modules\auth\forms;

use codexten\yii\modules\auth\helpers\UserHelper;
use codexten\yii\modules\auth\models\User;
use Yii;
use yii\base\Model;

/**
 * Model for collecting data on password recovery.
 *
 */
class RecoveryRequestForm extends Model implements RecoveryRequestFormInterface
{
    use RecoveryRequestFormTrait;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('codexten:user', 'Email'),
            'password' => Yii::t('codexten:user', 'Password'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'emailTrim' => ['email', 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
            'validateUser' => ['email', 'validateUser'],
        ];
    }

    public function validateUser($attribute)
    {
        $user = UserHelper::getUserByEmail($this->email);
        if ($user === null) {
            $this->addError($attribute, ' Can\'t find that email, sorry. ');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getUser(): User
    {
        return UserHelper::getUserByEmail($this->email);
    }

    /**
     * Sends recovery message.
     *
     * @return bool
     */
//    public function sendRecoveryMessage(): bool
//    {
//        if (!$this->validate()) {
//            return false;
//        }
//
//        $user = $this->finder->findUserByEmail($this->email);
//
//        if ($user instanceof User) {
//            /** @var Token $token */
//            $token = Yii::createObject([
//                'class' => Token::class,
//                'user_id' => $user->id,
//                'type' => Token::TYPE_RECOVERY,
//            ]);
//
//            if (!$token->save(false)) {
//                return false;
//            }
//
//            if (!$this->mailer->sendRecoveryMessage($user, $token)) {
//                return false;
//            }
//        }
//
//        Yii::$app->session->setFlash(
//            'info',
//            Yii::t('codexten:user', 'An email has been sent with instructions for resetting your password')
//        );
//
//        return true;
//    }

    /**
     * Resets user's password.
     *
     * @param Token $token
     *
     * @return bool
     */
//    public function resetPassword(Token $token)
//    {
//        if (!$this->validate() || $token->user === null) {
//            return false;
//        }
//
//        if ($token->user->resetPassword($this->password)) {
//            Yii::$app->session->setFlash('success',
//                Yii::t('codexten:user', 'Your password has been changed successfully.'));
//            $token->delete();
//        } else {
//            Yii::$app->session->setFlash(
//                'danger',
//                Yii::t('codexten:user',
//                    'An error occurred and your password has not been changed. Please try again later.')
//            );
//        }
//
//        return true;
//    }
}
