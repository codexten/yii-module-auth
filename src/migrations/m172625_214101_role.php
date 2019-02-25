<?php

namespace codexten\yii\modules\auth\migrations;

/**
 * Class m150625_214101_roles
 *
 * @package eii\migrations\rbac
 * @author Jomon Johnson <cto@codexten.com>
 */
class m172625_214101_role extends \codexten\yii\rbac\Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function up()
    {
        $this->auth->removeAll();

        $user = $this->auth->createRole('user');
        $this->auth->add($user);

        $admin = $this->auth->createRole('admin');
        $this->auth->add($admin);
        $this->auth->addChild($admin, $user);

        $this->auth->assign($admin, 1);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->auth->remove($this->auth->getRole('admin'));
        $this->auth->remove($this->auth->getRole('user'));
    }
}
