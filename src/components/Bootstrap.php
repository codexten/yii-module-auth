<?php


namespace codexten\yii\modules\auth\components;


use codexten\yii\admin\settings\components\AdminSettings;
use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        \AdminSettings::authModule()->forcePhoneNumberVerification;

        // TODO: Implement bootstrap() method.
    }
}