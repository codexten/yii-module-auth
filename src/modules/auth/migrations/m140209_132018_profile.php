<?php

namespace codexten\yii\modules\auth\migrations;

use yii\db\Migration;

/**
 * Class m140209_132017_init
 *
 * @package codexten\yii\modules\auth\migrations
 * @author Jomon Johnson <cto@codexten.com>
 */
class m140209_132018_profile extends Migration
{
    public function up()
    {
        $this->createTable('{{%profile}}', [
            'user_id' => $this->integer()->notNull()->append('PRIMARY KEY'),
            'name' => $this->string(255)->null(),
            'public_email' => $this->string(255)->null(),
            'gravatar_email' => $this->string(255)->null(),
            'gravatar_id' => $this->string(32)->null(),
            'location' => $this->string(255)->null(),
            'website' => $this->string(255)->null(),
            'bio' => $this->text()->null(),
            'timezone' => $this->string(40)->null(),
        ]);

        $this->addForeignKey('{{%fk_user_profile}}', '{{%profile}}', 'user_id', '{{%user}}', 'id', 'cascade',
            'restrict');
    }

    public function down()
    {
        $this->dropTable('{{%profile}}');
    }

    /**
     * @return array
     */
    public static function alternatives()
    {
        return [
            'entero\module\user\migrations\m140209_132018_profile',
        ];
    }
}
