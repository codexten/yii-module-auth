<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 10/12/18
 * Time: 9:53 PM
 */


/**
 * @var yii\web\View $this
 * @var \codexten\yii\web\User $model
 * @var \codexten\yii\modules\auth\Module $module
 */

$this->title = Yii::t('codexten:user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-auth-account-login">

    <?= $this->render('@codexten/yii/modules/auth/views/registration/register/_form.php', [
        'model' => $model,
        'module' => $module,
    ]) ?>

</div>