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
 * @var codexten\yii\modules\auth\models\User   $user
 * @var codexten\yii\modules\auth\models\Token  $token
 */
?>
<?= Yii::t('codexten:user', 'Hello') ?>,

<?= Yii::t('codexten:user', 'We have received a request to reset the password for your account on {0}', Yii::$app->name) ?>.
<?= Yii::t('codexten:user', 'Please click the link below to complete your password reset') ?>.

<?= $token->url ?>

<?= Yii::t('codexten:user', 'If you cannot click the link, please try pasting the text into your browser') ?>.

<?= Yii::t('codexten:user', 'If you did not make this request you can ignore this email') ?>.
