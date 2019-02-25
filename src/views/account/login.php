<?php

use codexten\yii\modules\auth\widgets\Connect;
use codexten\yii\modules\auth\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var codexten\yii\modules\auth\models\LoginForm $model
 * @var codexten\yii\modules\auth\Module $module
 */

$this->title = Yii::t('codexten:user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'validateOnBlur' => false,
    'validateOnType' => false,
    'validateOnChange' => false,
]) ?>

<?= $form->field($model, 'login',
    ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]);
?>

<?= $form->field(
    $model,
    'password',
    ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
    ->passwordInput()
    ->label(
        Yii::t('codexten:user', 'Password')
        . ($module->enablePasswordRecovery ?
            ' (' . Html::a(
                Yii::t('codexten:user', 'Forgot password?'),
                ['/user/recovery/request'],
                ['tabindex' => '5']
            )
            . ')' : '')
    ) ?>

<?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

<?= Html::submitButton(
    Yii::t('codexten:user', 'Sign in'),
    ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
) ?>

<?php ActiveForm::end(); ?>