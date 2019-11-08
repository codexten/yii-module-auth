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

            <?= $this->render('_message', compact(['model'])) ?>

            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'otp')->label(false) ?>

            <?= Html::submitButton() ?>

            <?php ActiveForm::end() ?>

        </div>
    </div>
</div>
