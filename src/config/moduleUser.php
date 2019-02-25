<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 8/3/18
 * Time: 3:07 PM
 */

return [
    'aliases' => [
        '@account' => '/user/account',
        '@registration' => '/user/registration',
    ],
    'bootstrap' => [
        \codexten\yii\modules\auth\components\SiteHelper::class,
    ],
    'components' => [
        'user' => [
            'identityClass' => \codexten\yii\modules\auth\models\User::class,
            'loginUrl' => ['/user/account/login'],
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
        'user' => [
            'class' => \codexten\yii\modules\auth\Module::class,
            'controllerNamespace' => 'codexten\yii\modules\auth\controllers',
            'viewPath' => '@codexten/yii/modules/auth/views',
            'layoutPath' => '@app/views/layout',
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
                'controllers' => ['user/account'],
                'allow' => true,
                'roles' => ['?', '@'],
            ],
            [
                'controllers' => ['user/registration'],
                'allow' => true,
                'actions' => ['register', 'connect'],
                'roles' => ['?'],
            ],
            [
                'controllers' => ['user/registration'],
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
];