<?php


namespace codexten\yii\modules\auth\migrations;


use yii\db\Migration;

/**
 * Class M191573199893Create_user_profile_table
 * @package codexten\yii\modules\auth\migrations
 */
class M191573199893Create_user_profile_table extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255),
            'middle_name' => $this->string(255),
            'last_name' => $this->string(255),
            'phone_no' => $this->string(50),
        ]);
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_profile}}');
    }
}