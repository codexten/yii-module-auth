<?php


namespace codexten\yii\modules\auth\forms;


use codexten\yii\modules\auth\models\User;
use yii\base\Model;

class PasswordResetForm extends Model
{
    public $password;
    public $repeat_password;
    /**
     * @var User
     */
    public $user;

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['password', 'repeat_password'], 'required'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        return $this->user->setPasswordHash($this->password);
    }

}
