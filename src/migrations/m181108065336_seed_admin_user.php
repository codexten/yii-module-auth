<?php

namespace codexten\yii\modules\auth\migrations;

use Yii;
use yii\base\Exception;
use yii\db\Migration;

/**
 * Class m181108065336_seed_admin_user
 *
 * @package codexten\yii\modules\auth\migrations
 */
class m181108065336_seed_admin_user extends Migration
{
    /**
     * @return bool|void
     * @throws Exception
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'admin',
            'email' => 'webmaster@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(32),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', [
            'id' => [1],
        ]);
    }
}
