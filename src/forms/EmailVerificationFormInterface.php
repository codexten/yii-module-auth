<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 7/3/19
 * Time: 4:47 PM
 */

namespace codexten\yii\modules\auth\forms;

/**
 * Interface PhoneNumberVerificationFormInterface
 *
 * @property $phoneNumber
 *
 * @package codexten\yii\modules\auth\forms
 */
interface EmailVerificationFormInterface
{
    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return bool
     */
    public function verify(): bool;

    /**
     * @return bool
     */
    public function sendOtp(): bool;
}
