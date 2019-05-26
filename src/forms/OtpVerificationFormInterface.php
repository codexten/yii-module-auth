<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 7/3/19
 * Time: 4:47 PM
 */

namespace codexten\yii\modules\auth\forms;


interface OtpVerificationFormInterface
{
    /**
     * @return string
     */
    public function getMobileNumber(): string;

    /**
     * @return bool
     */
    public function verify(): bool;

    /**
     * @return bool
     */
    public function sendOtpSms(): bool;
}