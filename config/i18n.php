<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 22/12/18
 * Time: 2:22 PM
 */

use yii\i18n\PhpMessageSource;

return [
    'translations' => [
        'codexten:user' => [
            'class' => PhpMessageSource::class,
            'basePath' => '@codexten/yii/modules/auth/messages',
        ],
    ],
];