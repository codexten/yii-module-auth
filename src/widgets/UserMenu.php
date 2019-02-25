<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace codexten\yii\modules\auth\widgets;

use yii\widgets\Menu;
use Yii;
use yii\base\Widget;

/**
 * User menu widget.
 */
class UserMenu extends Widget
{
    
    /** @array \codexten\yii\modules\auth\models\RegistrationForm */
    public $items;
    
    public function init()
    {
        parent::init();
        
        $networksVisible = count(Yii::$app->authClientCollection->clients) > 0;
        
        $this->items = [
                ['label' => Yii::t('codexten:user', 'Profile'), 'url' => ['/user/settings/profile']],
                ['label' => Yii::t('codexten:user', 'Account'), 'url' => ['/user/settings/account']],
                [
                    'label' => Yii::t('codexten:user', 'Networks'),
                    'url' => ['/user/settings/networks'],
                    'visible' => $networksVisible
                ],
            ];
    }
    
    /**
     * @inheritdoc
     */
    public function run()
    {
        return Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => $this->items,
        ]);
    }
}
