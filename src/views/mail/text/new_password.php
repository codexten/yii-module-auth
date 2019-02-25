<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var codexten\yii\modules\auth\models\User
 */
?>
<?= Yii::t('codexten:user', 'Hello') ?>,

<?= Yii::t('codexten:user', 'Your account on {0} has a new password', Yii::$app->name) ?>.
<?= Yii::t('codexten:user', 'We have generated a password for you') ?>:
<?= $user->password ?>

<?= Yii::t('codexten:user', 'If you did not make this request you can ignore this email') ?>.
