<?php

use codexten\yii\modules\auth\admin\AuthModuleSettings;

return [
    'components' => [
        'adminSettings' => [

        ],
    ],
    'modules' => [
        'settings' => [
            'sections' => [
                'auth' => [
                    'modelClass' => AuthModuleSettings::class,
                ],
            ],
        ],
    ],
];