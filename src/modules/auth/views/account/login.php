<?php
/**
 * @var yii\web\View $this
 * @var codexten\yii\modules\auth\models\LoginForm $model
 * @var codexten\yii\modules\auth\Module $module
 */

$this->title = Yii::t('codexten:user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-auth-account-login">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <?= $this->render('@moduleAuth/views/account/login/_form.php', [
                'model' => $model,
                'module' => $module,
            ]) ?>

        </div>
    </div>
</div>

