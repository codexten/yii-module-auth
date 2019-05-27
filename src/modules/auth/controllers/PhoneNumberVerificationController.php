<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 7/3/19
 * Time: 4:42 PM
 */

namespace codexten\yii\modules\auth\controllers;


use codexten\yii\modules\auth\forms\PhoneNumberVerificationFormInterface;
use codexten\yii\web\Controller;

class PhoneNumberVerificationController extends Controller
{
    /***
     * @var string
     */
    public $modelClass;


    public function actionIndex($resend = false)
    {
        /* @var $model PhoneNumberVerificationFormInterface */
        $model = new $this->modelClass();

        if ($resend) {
            $model->sendOtp();

            return $this->redirect('index');
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionSendOtp()
    {
        /* @var $model PhoneNumberVerificationFormInterface */
        $model = new $this->modelClass();
        $model->sendOtpSms();
    }
}