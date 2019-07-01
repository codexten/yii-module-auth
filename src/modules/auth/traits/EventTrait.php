<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace codexten\yii\modules\auth\traits;

use codexten\yii\modules\auth\events\AuthEvent;
use codexten\yii\modules\auth\events\ConnectEvent;
use codexten\yii\modules\auth\events\FormEvent;
use codexten\yii\modules\auth\events\ProfileEvent;
use codexten\yii\modules\auth\events\ResetPasswordEvent;
use codexten\yii\modules\auth\events\UserEvent;
use codexten\yii\modules\auth\models\Account;
use codexten\yii\modules\auth\models\Profile;
use codexten\yii\modules\auth\models\RecoveryForm;
use codexten\yii\modules\auth\models\Token;
use codexten\yii\modules\auth\models\User;
use Yii;
use yii\authclient\ClientInterface;
use yii\base\InvalidConfigException;
use yii\base\Model;

/**
 * @author Jomon Johnson <cto@codexten.com>
 */
trait EventTrait
{
    /**
     * @param  Model     $form
     * @return FormEvent
     * @throws InvalidConfigException
     */
    protected function getFormEvent(Model $form)
    {
        return Yii::createObject(['class' => FormEvent::class, 'form' => $form]);
    }

    /**
     * @param  User      $user
     * @return UserEvent
     * @throws InvalidConfigException
     */
    protected function getUserEvent(User $user)
    {
        return Yii::createObject(['class' => UserEvent::class, 'user' => $user]);
    }

    /**
     * @param  Profile      $profile
     * @return ProfileEvent
     * @throws InvalidConfigException
     */
    protected function getProfileEvent(Profile $profile)
    {
        return Yii::createObject(['class' => ProfileEvent::class, 'profile' => $profile]);
    }


    /**
     * @param  Account      $account
     * @param  User         $user
     * @return ConnectEvent
     * @throws InvalidConfigException
     */
    protected function getConnectEvent(Account $account, User $user)
    {
        return Yii::createObject(['class' => ConnectEvent::class, 'account' => $account, 'user' => $user]);
    }

    /**
     * @param  Account         $account
     * @param  ClientInterface $client
     * @return AuthEvent
     * @throws InvalidConfigException
     */
    protected function getAuthEvent(Account $account, ClientInterface $client)
    {
        return Yii::createObject(['class' => AuthEvent::class, 'account' => $account, 'client' => $client]);
    }

    /**
     * @param  Token        $token
     * @param  RecoveryForm $form
     * @return ResetPasswordEvent
     * @throws InvalidConfigException
     */
    protected function getResetPasswordEvent(Token $token = null, RecoveryForm $form = null)
    {
        return Yii::createObject(['class' => ResetPasswordEvent::class, 'token' => $token, 'form' => $form]);
    }
}
