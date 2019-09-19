<?php

namespace codexten\yii\modules\auth\actions;

use codexten\yii\web\actions\Action;

class AccountLoginAction extends Action
{
    use AccountLoginActionTrait;

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        if ($this->processLoginForm()) {
            return;
        }

        return $this->render();
    }
}
