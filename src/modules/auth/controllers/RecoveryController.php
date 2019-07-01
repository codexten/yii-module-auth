<?php

namespace codexten\yii\modules\auth\controllers;

use codexten\yii\modules\auth\AuthModule;
use codexten\yii\modules\auth\forms\PasswordResetForm;
use codexten\yii\modules\auth\forms\RecoveryRequestForm;
use codexten\yii\modules\auth\helpers\UserTokenHelper;
use codexten\yii\modules\auth\traits\AjaxValidationTrait;
use codexten\yii\modules\auth\traits\EventTrait;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidConfigException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * RecoveryController manages password recovery process.
 *
 * @property AuthModule $module
 *
 * @author Jomon Johnson <cto@codexten.com>
 */
class RecoveryController extends Controller
{
    use AjaxValidationTrait;
    use EventTrait;

//    /**
//     * Event is triggered before requesting password reset.
//     * Triggered with \codexten\yii\modules\auth\events\FormEvent.
//     */
//    const EVENT_BEFORE_REQUEST = 'beforeRequest';
//
//    /**
//     * Event is triggered after requesting password reset.
//     * Triggered with \codexten\yii\modules\auth\events\FormEvent.
//     */
//    const EVENT_AFTER_REQUEST = 'afterRequest';
//
//    /**
//     * Event is triggered before validating recovery token.
//     * Triggered with \codexten\yii\modules\auth\events\ResetPasswordEvent. May not have $form property set.
//     */
//    const EVENT_BEFORE_TOKEN_VALIDATE = 'beforeTokenValidate';
//
//    /**
//     * Event is triggered after validating recovery token.
//     * Triggered with \codexten\yii\modules\auth\events\ResetPasswordEvent. May not have $form property set.
//     */
//    const EVENT_AFTER_TOKEN_VALIDATE = 'afterTokenValidate';
//
//    /**
//     * Event is triggered before resetting password.
//     * Triggered with \codexten\yii\modules\auth\events\ResetPasswordEvent.
//     */
//    const EVENT_BEFORE_RESET = 'beforeReset';
//
//    /**
//     * Event is triggered after resetting password.
//     * Triggered with \codexten\yii\modules\auth\events\ResetPasswordEvent.
//     */
//    const EVENT_AFTER_RESET = 'afterReset';


    /**
     * @return string|Response
     * @throws NotFoundHttpException
     * @throws ExitException
     * @throws InvalidConfigException
     */
    public function actionRequest()
    {
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var RecoveryRequestForm $model */
        $model = Yii::createObject(['class' => RecoveryRequestForm::class,]);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->sendRecoveryMessage()) {
            Yii::$app->session->setFlash('success', 'Recovery message sent');

            return $this->refresh();
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }

    /**
     * Displays page where user can reset password.
     *
     * @param int $id
     * @param string $code
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionReset($id, $code)
    {
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        $token = UserTokenHelper::getPasswordRecoveryTokenByCode($code, $id);

        if ($token === null) {
            throw new NotFoundHttpException();
        }

        $model = new PasswordResetForm([
            'user' => $token->user,
        ]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $token->delete();

            return $this->render('reset/_message');
        }

        return $this->render('reset', [
            'model' => $model,
        ]);
    }

    /**
     * Displays page where user can reset password.
     *
     * @param int $id
     * @param string $code
     *
     * @return string
     * @throws NotFoundHttpException
     */
//    public function actionReset($id, $code)
//    {
//        if (!$this->module->enablePasswordRecovery) {
//            throw new NotFoundHttpException();
//        }
//
//        /** @var Token $token */
//        $token = $this->finder->findToken(['user_id' => $id, 'code' => $code, 'type' => Token::TYPE_RECOVERY])->one();
//        if (empty($token) || !$token instanceof Token) {
//            throw new NotFoundHttpException();
//        }
//        $event = $this->getResetPasswordEvent($token);
//
//        $this->trigger(self::EVENT_BEFORE_TOKEN_VALIDATE, $event);
//
//        if ($token === null || $token->isExpired || $token->user === null) {
//            $this->trigger(self::EVENT_AFTER_TOKEN_VALIDATE, $event);
//            Yii::$app->session->setFlash(
//                'danger',
//                Yii::t('codexten:user', 'Recovery link is invalid or expired. Please try requesting a new one.')
//            );
//
//            return $this->render('/message', [
//                'title' => Yii::t('codexten:user', 'Invalid or expired link'),
//                'module' => $this->module,
//            ]);
//        }
//
//        /** @var RecoveryRequestForm $model */
//        $model = Yii::createObject([
//            'class' => RecoveryRequestForm::class,
//            'scenario' => RecoveryRequestForm::SCENARIO_RESET,
//        ]);
//        $event->setForm($model);
//
//        $this->performAjaxValidation($model);
//        $this->trigger(self::EVENT_BEFORE_RESET, $event);
//
//        if ($model->load(Yii::$app->getRequest()->post()) && $model->resetPassword($token)) {
//            $this->trigger(self::EVENT_AFTER_RESET, $event);
//
//            return $this->render('/message', [
//                'title' => Yii::t('codexten:user', 'Password has been changed'),
//                'module' => $this->module,
//            ]);
//        }
//
//        return $this->render('reset', [
//            'model' => $model,
//        ]);
//    }
}
