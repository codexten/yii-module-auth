<?php

namespace codexten\yii\modules\auth\models;


use Yii;
use yii\base\Model;


/**
 * Class ResetPasswordForm
 *
 * @package codexten\yii\modules\auth\models
 */
class ResetPasswordForm extends Model
{
    /**
     * @var
     */
    public $password;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'confirm_password'], 'required'],
            [['password', 'confirm_password'], 'string', 'min' => 8],
            [
                'confirm_password',
                'compare',
                'compareAttribute' => 'password',
                'message' => 'Passwords don\'t match',
            ],
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = User::findOne(['id' => getMyId()]);

        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);

        return $user->save(false, ['password_hash']);
    }
}
