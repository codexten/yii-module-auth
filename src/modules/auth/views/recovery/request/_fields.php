<?php

use codexten\yii\modules\auth\forms\RecoveryRequestForm;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var RecoveryRequestForm $model
 */
?>

<?= $form->field($model, 'email') ?>

