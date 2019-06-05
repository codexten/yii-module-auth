<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 8/3/18
 * Time: 3:07 PM
 */

use codexten\yii\modules\auth\AuthModule;
use codexten\yii\modules\auth\components\SiteHelper;
use codexten\yii\modules\auth\controllers\AccountController;
use codexten\yii\modules\auth\controllers\EmailVerificationController;
use codexten\yii\modules\auth\controllers\PhoneNumberVerificationController;
use codexten\yii\modules\auth\controllers\RegistrationController;
use codexten\yii\modules\auth\models\LoginForm;
use codexten\yii\modules\auth\models\RegistrationForm;
use codexten\yii\modules\auth\models\User;

return [
    'aliases' => [
        '@moduleAuth' => '@codexten/yii/modules/auth',
        '@account' => '/user/account',
        '@registration' => '/user/registration',
    ],
    'bootstrap' => [
        SiteHelper::class,
    ],
    'components' => [
        'user' => [
            'identityClass' => User::class,
            'loginUrl' => ['/auth/account/login'],
            'logoutUrl' => ['/auth/account/logout'],
            'registerUrl' => ['/auth/registration/register'],
        ],
        'urlManager' => [
            'rules' => [
                '/account/forgot' => 'recovery/request',
                '/account/recover/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'recovery/reset',
                '/account/register' => '/user/registration/register',
                '/account/<action:(login|logout)>' => '/user/account/<action>',
            ],
        ],
    ],
    'modules' => [
        'auth' => [
            'class' => AuthModule::class,
            'controllerNamespace' => 'codexten\yii\modules\auth\controllers',
            'viewPath' => '@codexten/yii/modules/auth/views',
            'layoutPath' => '@app/views/layout',
            'controllerMap' => [
                'registration' => [
                    'class' => RegistrationController::class,
                ],
                'account' => [
                    'class' => AccountController::class,
                    'viewPath' => '@codexten/yii/module/auth/views',
                ],
                'phone-number-verification' => [
                    'class' => PhoneNumberVerificationController::class,
                ],
                'email-verification' => [
                    'class' => EmailVerificationController::class,
                ],
            ]
//            'as globalAccess' => [
//                'class' => '\codexten\yii\behaviors\GlobalAccessBehavior',
//                'rules' => [
//                    [
//                        'controllers' => ['account'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                        'actions' => ['login', 'login-by-token'],
//                    ],
////                    [
////                        'controllers' => ['sign-in'],
////                        'allow' => true,
////                        'roles' => ['@'],
////                        'actions' => ['logout'],
////                    ],
////                    [
////                        'controllers' => ['site'],
////                        'allow' => true,
////                        'roles' => ['?', '@'],
////                        'actions' => ['error'],
////                    ],
////                    [
////                        'controllers' => ['debug/default'],
////                        'allow' => true,
////                        'roles' => ['?'],
////                    ],
////                    [
////                        'controllers' => ['user'],
////                        'allow' => true,
////                        'roles' => ['admin'],
////                    ],
////                    [
////                        'controllers' => ['user'],
////                        'allow' => false,
////                    ],
////                    [
////                        'controllers' => ['sign-in'],
////                        'allow' => true,
////                        'roles' => ['@'],
////                    ],
////                    [
////                        'allow' => true,
////                        'roles' => ['admin'],
////                    ],
//                ],
//            ],
        ],
    ],
    'as globalAccess' => [
        'class' => '\codexten\yii\behaviors\GlobalAccessBehavior',
        'rules' => [
            [
                'controllers' => ['auth/account'],
                'allow' => true,
                'roles' => ['?', '@'],
            ],
            [
                'controllers' => ['auth/registration'],
                'allow' => true,
                'actions' => ['register', 'connect'],
                'roles' => ['?'],
            ],
            [
                'controllers' => ['auth/registration'],
                'allow' => true,
                'actions' => ['confirmation', 'resend'],
                'roles' => ['?', '@'],
            ],
            [
                'controllers' => ['debug/default'],
                'allow' => true,
                'roles' => ['?'],
            ],
//            [
//                'controllers' => ['user'],
//                'allow' => true,
//                'roles' => ['?'],
//            ],
//                    [
//                        'controllers' => ['sign-in'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                        'actions' => ['logout'],
//                    ],
//                    [
//                        'controllers' => ['site'],
//                        'allow' => true,
//                        'roles' => ['?', '@'],
//                        'actions' => ['error'],
//                    ],
//                    [
//                        'controllers' => ['debug/default'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'controllers' => ['user'],
//                        'allow' => true,
//                        'roles' => ['admin'],
//                    ],
//                    [
//                        'controllers' => ['user'],
//                        'allow' => false,
//                    ],
//                    [
//                        'controllers' => ['sign-in'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                    [
//                        'allow' => true,
//                        'roles' => ['admin'],
//                    ],
        ],
    ],
    'container' => [
        'definitions' => [
            \codexten\yii\modules\auth\actions\AccountLoginAction::class => [
                'modelClass' => LoginForm::class,
                'layout' => '/base',
            ],
            \codexten\yii\modules\auth\actions\RegistrationRegisterAction::class => [
                'modelClass' => RegistrationForm::class,
                'layout' => '/base',
            ],
        ],
    ],
];
