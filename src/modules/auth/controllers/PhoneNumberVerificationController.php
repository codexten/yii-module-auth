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
use yii\base\Model;
use yii\helpers\Url;

class PhoneNumberVerificationController extends Controller
{
    /***
     * @var string
     */
    public $modelClass;


    public function actionIndex($resent = false)
    {
        if (\Yii::$app->userSettings->get('auth.mobileVerified')) {
            return $this->goHome();
        }

        /* @var $model PhoneNumberVerificationFormInterface|Model */
        $model = new $this->modelClass();

        if ($resent) {
            $model->sendOtp();

            return $this->redirect(Url::current(['resent' => null]));
        }

        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->verify()) {

            return $this->refresh();
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
