<?php

namespace codexten\yii\modules\auth\actions;

use codexten\yii\modules\auth\models\RegistrationForm;
use codexten\yii\modules\auth\traits\AjaxValidationTrait;
use codexten\yii\web\actions\ActionTrait;
use Yii;

trait RegistrationRegisterActionTrait
{
    use AjaxValidationTrait;
    use ActionTrait;

    public function processRegistrationForm($map = [])
    {
//        if (!$this->module->enableRegistration) {
//            throw new NotFoundHttpException();
//        }

        /** @var RegistrationForm $model */
        $model = Yii::createObject($this->modelClass);

//        $event = $this->getFormEvent($model);
//        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            $this->trigger(self::EVENT_AFTER_REGISTER, $event);
            Yii::$app->getSession()->setFlash('success', Yii::t('codexten:user', 'Your account has been created'));

            if ($this->module->enableAutoLoginAfterRegistration) {

                Yii::$app->getUser()->login($model->getUser());
            }


            return $this->goHome();
        }

        $this->setViewParams([
            'model' => $model,
            'module' => $this->controller->module,
        ], $map);
    }
}
