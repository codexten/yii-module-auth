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

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        if ($this->processRegistrationForm()) {
            return;
        }

        return $this->render();
    }
}
