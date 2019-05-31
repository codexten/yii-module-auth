<?php

namespace codexten\yii\modules\auth\controllers;

use codexten\yii\helpers\ArrayHelper;
use codexten\yii\modules\auth\actions\AccountLoginAction;
use codexten\yii\modules\auth\Finder;
use codexten\yii\modules\auth\models\ForgotPasswordForm;
use codexten\yii\modules\auth\models\LoginForm;
use codexten\yii\modules\auth\Module;
use codexten\yii\modules\auth\traits\AjaxValidationTrait;
use codexten\yii\modules\auth\traits\EventTrait;
use codexten\yii\web\Controller;
use Yii;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\base\ExitException;
use yii\base\InvalidConfigException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\Response;


/**
 * Controller that manages user authentication process.
 *
 * @property AuthModule $module
 *
 * @author Jomon Johnson <cto@codexten.com>
 */
class AccountController extends Controller
{
    use AjaxValidationTrait;
    use EventTrait;

    /**
     * Event is triggered before logging user in.
     * Triggered with \codexten\yii\modules\auth\events\FormEvent.
     */
    const EVENT_BEFORE_LOGIN = 'beforeLogin';
    /**
     * Event is triggered after logging user in.
     * Triggered with \codexten\yii\modules\auth\events\FormEvent.
     */
    const EVENT_AFTER_LOGIN = 'afterLogin';
    /**
     * Event is triggered before logging user out.
     * Triggered with \codexten\yii\modules\auth\events\UserEvent.
     */
    const EVENT_BEFORE_LOGOUT = 'beforeLogout';
    /**
     * Event is triggered after logging user out.
     * Triggered with \codexten\yii\modules\auth\events\UserEvent.
     */
    const EVENT_AFTER_LOGOUT = 'afterLogout';
    /**
     * Event is triggered before authenticating user via social network.
     * Triggered with \codexten\yii\modules\auth\events\AuthEvent.
     */
    const EVENT_BEFORE_AUTHENTICATE = 'beforeAuthenticate';
    /**
     * Event is triggered after authenticating user via social network.
     * Triggered with \codexten\yii\modules\auth\events\AuthEvent.
     */
    const EVENT_AFTER_AUTHENTICATE = 'afterAuthenticate';
    /**
     * Event is triggered before connecting social network account to user.
     * Triggered with \codexten\yii\modules\auth\events\AuthEvent.
     */
    const EVENT_BEFORE_CONNECT = 'beforeConnect';
    /**
     * Event is triggered before connecting social network account to user.
     * Triggered with \codexten\yii\modules\auth\events\AuthEvent.
     */
    const EVENT_AFTER_CONNECT = 'afterConnect';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'login' => ArrayHelper::merge([
                'class' => AccountLoginAction::class,
                'modelClass' => LoginForm::class,
                'layout' => '/base',
            ], Yii::$container->definitions[AccountLoginAction::class]),
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'logout') {
            //Temporary fix for GiveNTake
            // can' log out from actions inside modules
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays the login page.
     *
     * @return string|Response
     * @throws ExitException
     * @throws InvalidConfigException
     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            $this->goHome();
//        }
//
//        /** @var LoginForm $model */
//        $model = Yii::createObject(LoginForm::class);
//        $event = $this->getFormEvent($model);
//
//        $this->performAjaxValidation($model);
//
//        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);
//
//        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
//            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
//
//            return $this->goBack();
//        }
//
//        $this->layout = '/base';
//
//        return $this->render('login', [
//            'model' => $model,
//            'module' => $this->module,
//        ]);
//    }

    /**
     * Logs the user out and then redirects to the homepage.
     *
     * @return Response
     * @throws InvalidConfigException
     */
    public function actionLogout()
    {
        $event = $this->getUserEvent(Yii::$app->user->identity);

        $this->trigger(self::EVENT_BEFORE_LOGOUT, $event);

        Yii::$app->getUser()->logout();

        $this->trigger(self::EVENT_AFTER_LOGOUT, $event);

        return $this->goHome();
    }

    public function actionLoginByToken($username, $token)
    {
        Yii::$app->user->logout();
        $this->layout = 'base';

        $model = new LoginForm();
        $model->login = $username;
        if (!$model->loginByToken($token)) {
            throw new ForbiddenHttpException();
        }

        return $this->redirect('/');
    }

    public function actionForgotPassword()
    {
        $this->layout = '/base';
        $model = new ForgotPasswordForm();
        $message = '';
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->sendPassword()) {
            $message = 'new password generated . please check your inbox.';
        }

        return $this->render('forgot-password', [
            'model' => $model,
            'message' => $message,
        ]);
    }
}
