<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 7/3/19
 * Time: 4:47 PM
 */

namespace codexten\yii\modules\auth\forms;


use codexten\yii\web\widgets\settings\Form;

abstract class OtpVerificationForm extends Form
{
    public $otp;

    

    public function save()
    {

    }

    abstract public function getMobileNumber();

    abstract public function verify();

    public function sendOtp()
    {

    }
}