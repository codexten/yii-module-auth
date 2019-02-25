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

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">

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
            </div>
        </div>

        <?php if ($module->enableConfirmation): ?>

            <p class="text-center">
                <?= Html::a(Yii::t('codexten:user', 'Didn\'t receive confirmation message?'),
                    ['/user/registration/resend']) ?>
            </p>

        <?php endif ?>

        <?php if ($module->enableRegistration): ?>

            <p class="text-center">
                <?= Html::a(Yii::t('codexten:user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
            </p>

        <?php endif ?>

    </div>
</div>
