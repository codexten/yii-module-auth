<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 7/3/19
 * Time: 4:47 PM
 */

namespace codexten\yii\modules\auth\forms;


interface PhoneNumberVerificationFormInterface
{
    /**
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * @return bool
     */
    public function verify(): bool;

    /**
     * @return bool
     */
    public function sendOtp(): bool;
}