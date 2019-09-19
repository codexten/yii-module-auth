<?php

use codexten\yii\modules\auth\forms\PhoneNumberVerificationFormInterface;
use yii\helpers\Html;

/* @var $model PhoneNumberVerificationFormInterface */
?>
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
