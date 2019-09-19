<?php

use codexten\yii\modules\auth\forms\RecoveryRequestForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var RecoveryRequestForm $model
 * @var array $_params_
 */
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
]); ?>

<?= $this->render('_fields', compact(['form', 'model'])) ?>

<?= Html::submitButton(Yii::t('codexten:user', 'Continue'), ['class' => 'btn btn-primary btn-block']) ?>
<br>

<?php ActiveForm::end(); ?>
