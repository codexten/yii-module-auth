<?php

use codexten\yii\modules\auth\forms\PhoneNumberVerificationFormInterface;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $model PhoneNumberVerificationFormInterface */
/* @var $this View */
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="text-center">
            <h4>Verify PIN</h4>
            <p>
                A temporary PIN code has been sent to <b><?= $model->email ?></b>.
            </p>
            <p>
                Please enter OTP below to verify your email.
            </p>

            <p>
                click <?= Html::a('here', ['resent' => true]) ?> to
                <resend class=""></resend>
            </p>

            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'otp')->label(false) ?>

            <?= Html::submitButton() ?>

            <?php ActiveForm::end() ?>

        </div>
    </div>
</div>
