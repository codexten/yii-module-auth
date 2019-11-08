<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use codexten\yii\modules\auth\forms\RecoveryRequestForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var RecoveryRequestForm $model
 * @var array $_params_
 */

$this->title = Yii::t('codexten:user', 'Recover your password');
?>

<div class="page-auth-recovery-request">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <?= $this->render('request/_form', $_params_) ?>

        </div>
    </div>
</div>
