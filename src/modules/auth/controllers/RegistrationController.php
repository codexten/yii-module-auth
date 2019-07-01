<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 10/12/18
 * Time: 8:46 PM
 */

namespace codexten\yii\modules\auth\controllers;


//use dektrium\user\Finder;
use codexten\yii\modules\auth\actions\RegistrationRegisterAction;
use codexten\yii\modules\auth\AuthModule;
use codexten\yii\modules\auth\models\RegistrationForm;
use codexten\yii\modules\auth\Module;
use codexten\yii\modules\auth\traits\AjaxValidationTrait;
use codexten\yii\modules\auth\traits\EventTrait;
use Throwable;
use yii\base\ExitException;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

//use dektrium\user\models\ResendForm;

/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property AuthModule $module
 */
class RegistrationController extends Controller
{
    use AjaxValidationTrait;
    use EventTrait;

    /**
     * Event is triggered after creating RegistrationForm class.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_BEFORE_REGISTER = 'beforeRegister';

    /**
     * Event is triggered after successful registration.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_AFTER_REGISTER = 'afterRegister';

    /**
     * Event is triggered before connecting user to social account.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_BEFORE_CONNECT = 'beforeConnect';

    /**
     * Event is triggered after connecting user to social account.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_AFTER_CONNECT = 'afterConnect';

    /**
     * Event is triggered before confirming user.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_BEFORE_CONFIRM = 'beforeConfirm';

    /**
     * Event is triggered before confirming user.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_AFTER_CONFIRM = 'afterConfirm';

    /**
     * Event is triggered after creating ResendForm class.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_BEFORE_RESEND = 'beforeResend';

    /**
     * Event is triggered after successful resending of confirmation email.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_AFTER_RESEND = 'afterResend';

    public $layout = '/base';

    public function actions()
    {
        return [
            'register' => [
                'class' => RegistrationRegisterAction::class,
            ],
        ];
    }


    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws ExitException
     * @throws InvalidConfigException
     * @throws Exception
     */
//    public function actionRegister()
//    {
//
//    }

//    /**
//     * Displays page where user can create new account that will be connected to social account.
//     *
//     * @param string $code
//     *
//     * @return string
//     * @throws NotFoundHttpException
//     * @throws \yii\base\InvalidConfigException
//     */
//    public function actionConnect($code)
//    {
//        $account = $this->finder->findAccount()->byCode($code)->one();
//
//        if ($account === null || $account->getIsConnected()) {
//            throw new NotFoundHttpException();
//        }
//
//        /** @var User $user */
//        $user = \Yii::createObject([
//            'class' => User::class,
//            'scenario' => 'connect',
//            'username' => $account->username,
//            'email' => $account->email,
//        ]);
//
//        $event = $this->getConnectEvent($account, $user);
//
//        $this->trigger(self::EVENT_BEFORE_CONNECT, $event);
//
//        if ($user->load(\Yii::$app->request->post()) && $user->create()) {
//            $account->connect($user);
//            $this->trigger(self::EVENT_AFTER_CONNECT, $event);
//            \Yii::$app->user->login($user, $this->module->rememberFor);
//
//            return $this->goBack();
//        }
//
//        return $this->render('connect', [
//            'model' => $user,
//            'account' => $account,
//        ]);
//    }
//
//    /**
//     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
//     * shows error message.
//     *
//     * @param int $id
//     * @param string $code
//     *
//     * @return string
//     * @throws \yii\web\HttpException
//     * @throws \yii\base\InvalidConfigException
//     */
//    public function actionConfirm($id, $code)
//    {
//        $user = $this->finder->findUserById($id);
//
//        if ($user === null || $this->module->enableConfirmation == false) {
//            throw new NotFoundHttpException();
//        }
//
//        $event = $this->getUserEvent($user);
//
//        $this->trigger(self::EVENT_BEFORE_CONFIRM, $event);
//
//        $user->attemptConfirmation($code);
//
//        $this->trigger(self::EVENT_AFTER_CONFIRM, $event);
//
//        return $this->render('/message', [
//            'title' => \Yii::t('user', 'Account confirmation'),
//            'module' => $this->module,
//        ]);
//    }
//
//    /**
//     * Displays page where user can request new confirmation token. If resending was successful, displays message.
//     *
//     * @return string
//     * @throws NotFoundHttpException
//     * @throws \yii\base\ExitException
//     * @throws \yii\base\InvalidConfigException
//     */
//    public function actionResend()
//    {
//        if ($this->module->enableConfirmation == false) {
//            throw new NotFoundHttpException();
//        }
//
//        /** @var ResendForm $model */
//        $model = \Yii::createObject(ResendForm::class);
//        $event = $this->getFormEvent($model);
//
//        $this->trigger(self::EVENT_BEFORE_RESEND, $event);
//
//        $this->performAjaxValidation($model);
//
//        if ($model->load(\Yii::$app->request->post()) && $model->resend()) {
//            $this->trigger(self::EVENT_AFTER_RESEND, $event);
//
//            return $this->render('/message', [
//                'title' => \Yii::t('user', 'A new confirmation link has been sent'),
//                'module' => $this->module,
//            ]);
//        }
//
//        return $this->render('resend', [
//            'model' => $model,
//        ]);
//    }
}
