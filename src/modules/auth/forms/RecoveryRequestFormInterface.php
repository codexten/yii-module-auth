<?php


namespace codexten\yii\modules\auth\forms;


use codexten\yii\modules\auth\models\User;

/**
 * Interface RecoveryRequestFormInterface
 *
 * @property User $user
 * @property string $recoveryUrl
 * @property string $token
 *
 * @package codexten\yii\modules\auth\forms
 */
interface RecoveryRequestFormInterface
{
    public function sendRecoveryMessage(): bool;

    public function getUser(): User;

    public function getRecoveryUrl(): string;

    public function getToken(): string;
}
