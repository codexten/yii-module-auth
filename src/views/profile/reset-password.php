<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use codexten\yii\web\widgets\Page;

/* @var $this yii\web\View */
/* @var $form ActiveForm */

$this->title = 'Reset Password';
?>
<?php $page = Page::begin(
    [
        'title' => $this->title,
        'layout' => 'default',
    ]
) ?>

<?php $page->beginContent('content') ?>

<div class="row">
    <div class="col-md-4">

        <?php $form = ActiveForm::begin([
            'id' => 'reset-password-form',
            'options' => ['class' => 'login-form'],
        ]); ?>

        <?= $form->field($model, 'password')->passwordInput([]) ?>

        <?= $form->field($model, 'confirm_password')->passwordInput([]) ?>

        <div class="form-actions pull-right">

            <?= Html::submitButton('Reset Password', ['class' => 'btn btn-primary']) ?>

        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $page->endContent() ?>

<?php $page->end() ?>

