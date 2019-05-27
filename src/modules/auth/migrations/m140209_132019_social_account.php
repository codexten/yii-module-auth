<?php

namespace codexten\yii\modules\auth\migrations;

/**
 * Class m140209_132017_init
 *
 * @package codexten\yii\modules\auth\migrations
 * @author Jomon Johnson <cto@codexten.com>
 */
class m140209_132019_social_account extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{%social_account}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null(),
            'provider' => $this->string()->notNull(),
            'client_id' => $this->string()->notNull(),
            'properties' => $this->text()->null(),
            'code' => $this->string(32)->null(),
            'created_at' => $this->integer()->null(),
            'email' => $this->string()->null(),
            'username' => $this->string()->null(),
        ]);

        $this->createIndex('{{%social_account_unique}}', '{{%social_account}}', ['provider', 'client_id'], true);
        $this->addForeignKey('{{%fk_user_social_account}}', '{{%social_account}}', 'user_id', '{{%user}}', 'id',
            'cascade', 'restrict');
        $this->createIndex('{{%account_unique_code}}', '{{%social_account}}', 'code', true);
    }

    public function down()
    {
        $this->dropTable('{{%social_account}}');
    }
}
