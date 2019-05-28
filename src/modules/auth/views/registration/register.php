<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 10/12/18
 * Time: 9:53 PM
 */


/**
 * @var yii\web\View $this
 * @var User $model
 * @var AuthModule $module
 */

$this->title = Yii::t('codexten:user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;

use codexten\yii\modules\auth\AuthModule;
use codexten\yii\web\User; ?>
<div class="page-auth-account-login">

    <?= $this->render('@codexten/yii/modules/auth/views/registration/register/_form.php', [
        'model' => $model,
        'module' => $module,
    ]) ?>

</div>