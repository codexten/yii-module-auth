<?php

use codexten\yii\modules\auth\AuthModule;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var codexten\yii\modules\auth\models\LoginForm $model
 * @var AuthModule $module
 */
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'validateOnBlur' => false,
    'validateOnType' => false,
    'validateOnChange' => false,
]) ?>

<?= $form->field($model, 'login') ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

<?= Html::submitButton(Yii::t('codexten:user', 'Sign in'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<?php if ($module->enableRegistration): ?>

    <p class="text-center">
        <?= Html::a(Yii::t('codexten:user', 'Don\'t have an account? Sign up!'),
            ['/auth/registration/register']) ?>
    </p>

<?php endif ?>

<?php if ($module->enablePasswordRecovery): ?>

    <p class="text-center">
        <?= Html::a('Forgot password?', ['/auth/recovery/request']) ?>
    </p>

<?php endif ?>


