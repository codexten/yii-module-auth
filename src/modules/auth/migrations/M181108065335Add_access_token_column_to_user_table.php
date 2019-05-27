<?php

namespace codexten\yii\modules\auth\migrations;

use yii\db\Migration;

/**
 * Handles adding access_token to table `{{%user}}`.
 */
class M181108065335Add_access_token_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'access_token', 'string(40) NOT NULL AFTER `auth_key`');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'access_token');
    }
}
