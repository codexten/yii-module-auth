<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace codexten\yii\modules\auth\filters;

use yii\base\Action;
use yii\base\ActionFilter;
use yii\web\NotFoundHttpException;

/**
 * FrontendFilter is used to restrict access to admin controller in frontend when using Yii2-user with Yii2
 * advanced template.
 *
 * @author Jomon Johnson <cto@codexten.com>
 */
class FrontendFilter extends ActionFilter
{
    /**
     * @var array
     */
    public $controllers = ['admin'];

    /**
     * @param Action $action
     *
     * @return bool
     * @throws NotFoundHttpException
     */
    public function beforeAction($action)
    {
        if (in_array($action->controller->id, $this->controllers)) {
            throw new NotFoundHttpException('Not found');
        }

        return true;
    }
}
