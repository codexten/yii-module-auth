<?php

namespace codexten\yii\modules\auth\models;

use codexten\yii\modules\auth\helpers\Password;
use codexten\yii\modules\auth\traits\ModuleTrait;
use Yii;
use yii\base\Model;

/**
 * LoginForm get user's login and password, validates them and logs the user in. If user has been blocked, it adds
 * an error to login form.
 *
 * @author Jomon Johnson <cto@codexten.com>
 */
class LoginForm extends Model
{
    use ModuleTrait;

    /** @var string User's email or username */
    public $login;
    /** @var string User's plain password */
    public $password;
    /** @var string Whether to remember the user */
    public $rememberMe = false;

    /** @var \codexten\yii\modules\auth\models\User */
    protected $user;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => Yii::t('codexten:user', 'Username'),
            'password' => Yii::t('codexten:user', 'Password'),
            'rememberMe' => Yii::t('codexten:user', 'Remember me next time'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'loginTrim' => ['login', 'trim'],
            'requiredFields' => [['login', 'password'], 'required'],
            'confirmationValidate' => ['login', 'validateLogin'],
            'rememberMe' => ['rememberMe', 'boolean'],
            'passwordValidate' => ['password', 'validatePassword'],
        ];
    }

    protected function getUser()
    {
        return User::find()->where([
            'or',
            ['username' => $this->login],
            ['email' => $this->login],
        ])->one();
    }

    /**
     * Validate username
     *
     * @param $attribute
     *
     * @return bool
     */
    public function validateLogin($attribute)
    {
        $this->user = $this->getUser();

        if ($this->user === null) {
            return false;
        }

//        $confirmationRequired = $this->module->enableConfirmation && !$this->module->enableUnconfirmedLogin;

//        if ($confirmationRequired && !$this->user->getIsConfirmed()) {
//            $this->addError($attribute, Yii::t('codexten:user', 'You need to confirm your email address'));
//        }

        return true;
    }

    /**
     * Validates if the hash of the given password is identical to the saved hash in the database.
     * It will always succeed if the module is in DEBUG mode.
     *
     * @return void
     */
    public function validatePassword($attribute)
    {
        if ($this->user === null || !Password::validate($this->password, $this->user->password_hash)) {
            $this->addError($attribute, Yii::t('codexten:user', 'Invalid login or password'));
        }
    }

    /**
     * Validates form and logs the user in.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate() && $this->user) {
            $isLogged = Yii::$app->getUser()->login($this->user, $this->rememberMe ? $this->module->rememberFor : 0);

            if ($isLogged) {
                $this->user->updateAttributes(['logged_at' => time()]);
            }

            return $isLogged;
        }

        return false;
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public function loginByToken($token)
    {
        $user = $this->getUser();
        if (!$user || $user->access_token != $token) {
            return false;
        }

        if (Yii::$app->user->login($this->getUser())) {
            return true;
        }

        return false;
    }
}
