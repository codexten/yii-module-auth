<?php

namespace codexten\yii\modules\auth\actions;


use codexten\yii\modules\auth\models\LoginForm;
use codexten\yii\modules\auth\traits\AjaxValidationTrait;
use codexten\yii\web\actions\ActionTrait;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidConfigException;

trait AccountLoginActionTrait
{
    use AjaxValidationTrait;
    use ActionTrait;

    /**
     * @param array $map
     *
     * @return mixed
     * @throws ExitException
     * @throws InvalidConfigException
     */
    public function processLoginForm($map = [])
    {
        /** @var LoginForm $model */
        $model = Yii::createObject($this->modelClass);
        $this->performAjaxValidation($model);

        //        $event = $this->getFormEvent($model);
//        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {

//            $this->trigger(self::EVENT_AFTER_LOGIN, $event);

            return $this->redirect('/');
        }

        $this->setViewParams([
            'model' => $model,
            'module' => $this->controller->module,
        ], $map);
    }

}
