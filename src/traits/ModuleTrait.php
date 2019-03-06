<?php

namespace codexten\yii\modules\auth\traits;

use codexten\yii\modules\auth\Module;

/**
 * Trait ModuleTrait
 *
 * @property-read AuthModule $module
 * @package codexten\yii\modules\auth\traits
 * @author Jomon Johnson <cto@codexten.com>
 */
trait ModuleTrait
{
    /**
     * @return AuthModule
     */
    public function getModule()
    {
        return \Yii::$app->getModule('auth');
    }
}
