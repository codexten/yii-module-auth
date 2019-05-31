<?php

namespace codexten\yii\modules\auth\actions;


use codexten\yii\modules\auth\models\LoginForm;
use codexten\yii\modules\auth\traits\AjaxValidationTrait;
use codexten\yii\web\actions\Action;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidConfigException;

class AccountLoginAction extends Action
{
    use AjaxValidationTrait;

    /**
     * @return mixed
     * @throws ExitException
     * @throws InvalidConfigException
     */
    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }
        /** @var LoginForm $model */
        $model = Yii::createObject($this->modelClass);
        $this->performAjaxValidation($model);

        //        $event = $this->getFormEvent($model);
//        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
//            $this->trigger(self::EVENT_AFTER_LOGIN, $event);

            return $this->controller->goBack();
        }

        return $this->render('login', [
            'model' => $model,
            'module' => $this->controller->module,
        ]);

    }
}
