<?php
/**
 * @var yii\web\View $this
 * @var codexten\yii\modules\auth\models\LoginForm $model
 * @var codexten\yii\modules\auth\Module $module
 */

$this->title = Yii::t('codexten:user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('@codexten/yii/modules/auth/views/account/login/_form.php', [
    'model' => $model,
    'module' => $module,
]) ?>