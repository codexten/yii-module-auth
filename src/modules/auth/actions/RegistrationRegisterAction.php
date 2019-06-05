<?php

namespace codexten\yii\modules\auth\actions;

use codexten\yii\web\actions\Action;

class RegistrationRegisterAction extends Action
{
    use RegistrationRegisterActionTrait;

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
