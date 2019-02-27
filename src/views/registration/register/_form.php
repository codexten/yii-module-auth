<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 27/2/19
 * Time: 11:39 AM
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
]); ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'username') ?>

<?php if ($module->enableGeneratingPassword == false): ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
<?php endif ?>

<?= Html::submitButton(Yii::t('codexten:user', 'Sign up')) ?>

<?php ActiveForm::end(); ?>

<?= Html::a(Yii::t('codexten:user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
