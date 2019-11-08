<?php

namespace codexten\yii\modules\auth\migrations;

use yii\db\Migration;

/**
 * Class m140209_132017_init
 *
 * @package codexten\yii\modules\auth\migrations
 * @author Jomon Johnson <cto@codexten.com>
 */
class m140209_132020_token extends Migration
{
    public function up()
    {
        $this->createTable('{{%token}}', [
            'user_id' => $this->integer()->notNull(),
            'code' => $this->string(32)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'type' => $this->smallInteger()->notNull(),
        ]);

        $this->createIndex('{{%token_unique}}', '{{%token}}', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('{{%fk_user_token}}', '{{%token}}', 'user_id', '{{%user}}', 'id', 'cascade',
            'restrict');

    }

    public function down()
    {
        $this->dropTable('{{%token}}');
    }
}
