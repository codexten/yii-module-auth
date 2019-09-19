<?php

use codexten\yii\modules\auth\forms\PasswordResetForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var PasswordResetForm $model
 * @var array $_params_
 */

$this->title = Yii::t('codexten:user', 'Reset your password');
?>

<div class="page-auth-recovery-reset">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'repeat_password')->passwordInput() ?>

            <?= Html::submitButton(Yii::t('codexten:user', 'save'), ['class' => 'btn btn-primary btn-block']) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
