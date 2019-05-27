<?php

namespace codexten\yii\modules\auth\admin;

use codexten\yii\settings\models\BaseSettingsModel;

/**
 * Class AuthModuleSettings
 *
 * @property boolean $forcePhoneNumberVerification
 *
 * @package codexten\yii\modules\auth\admin
 */
class AuthModuleSettings extends BaseSettingsModel
{
    public $enableRegistration;
}