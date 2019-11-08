<?php

namespace codexten\yii\modules\auth\actions;

use codexten\yii\modules\auth\traits\ModuleTrait;
use codexten\yii\web\actions\Action;

class RegistrationRegisterAction extends Action
{
    use RegistrationRegisterActionTrait;

    use ModuleTrait;

    const EVENT_BEFORE_REGISTER = 'beforeRegister';
    const EVENT_AFTER_REGISTER = 'afterRegister';

    public $beforeAction = false;

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        if (is_callable($this->beforeAction)) {
            
            $beforeAction = call_user_func($this->beforeAction);
            if ($beforeAction) {
                return $beforeAction;
            }
        }

        if ($this->processRegistrationForm()) {
            return;
        }

        return $this->render();
    }
}
