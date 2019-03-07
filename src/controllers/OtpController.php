<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 7/3/19
 * Time: 4:42 PM
 */

namespace codexten\yii\modules\auth\controllers;


use codexten\yii\modules\auth\forms\OtpVerificationForm;
use codexten\yii\web\Controller;

class OtpController extends Controller
{
    public $modelClass = OtpVerificationForm::class;

    public function actionSendOpt()
    {
        /* @var $model OtpVerificationForm */
        $model = new $this->modelClass();
        $model->sendOtp();
    }
}