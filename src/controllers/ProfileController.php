<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace codexten\yii\modules\auth\controllers;

use codexten\yii\modules\auth\Finder;
use codexten\yii\modules\auth\models\ResetPasswordForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProfileController shows users profiles.
 *
 * @property \codexten\yii\modules\auth\AuthModule $module
 *
 * @author Jomon Johnson <cto@codexten.com>
 */
class ProfileController extends Controller
{
    /** @var Finder */
    protected $finder;

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['index'], 'roles' => ['@']],
                    ['allow' => true, 'actions' => ['show'], 'roles' => ['?', '@']],
                ],
            ],
        ];
    }

    /**
     * Redirects to current user's profile.
     *
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->redirect(['show', 'id' => \Yii::$app->user->getId()]);
    }

    /**
     * Shows user's profile.
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionShow($id)
    {
        $profile = $this->finder->findProfileById($id);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
        ]);
    }

    /**
     * @param $token
     *
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword()
    {

        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {

            setFlash('success', ['message' => 'New password was saved.']);

            return $this->refresh();
        }

        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }
}
