<?php

namespace codexten\yii\modules\auth\components;

use yii\base\Component;
use yii\helpers\Url;
use Yii;
use yii\base\BootstrapInterface;
use yii\web\Application;
use function userIdentity;

/**
 * Class SiteHelper
 *
 * @package codexten\yii\modules\auth\components
 */
class SiteHelper extends Component implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->on(Application::EVENT_BEFORE_REQUEST, function ($event) use ($app) {

            $user = Yii::$app->user->identity;
            if ($user && !$user->canLogin()) {

                Yii::$app->user->logout();

                return $app->response->refresh();
            }

            return true;
        });

    }
}