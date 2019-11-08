<?php


namespace codexten\yii\modules\auth\helpers;


use codexten\yii\modules\auth\models\User;
use codexten\yii\web\helpers\UserHelper as BaseUserHelper;

class UserHelper extends BaseUserHelper
{
    public static function getUserByUsername($username)
    {
        return User::findOne(['username' => $username]);
    }

    public static function getUserByEmail($email)
    {
        return User::findOne(['email' => $email]);
    }
}
