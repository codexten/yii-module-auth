<?php

use codexten\yii\modules\auth\AuthModule;
use codexten\yii\web\User;

/**
 * @var yii\web\View $this
 * @var User $model
 * @var AuthModule $module
 */

$this->title = Yii::t('codexten:user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-auth-account-login">

    <?= $this->render('@moduleAuth/views/registration/register/_form.php', [
        'model' => $model,
        'module' => $module,
    ]) ?>

</div>
