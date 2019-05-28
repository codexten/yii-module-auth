<?php

namespace codexten\yii\modules\auth\migrations;

use yii\db\Migration;

/**
 * Class M190307173026Rename_token_table_to_user_token
 */
class M190307173026Rename_token_table_to_user_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('{{%token}}', '{{%user_token}}');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('{{%user_token}}', '{{%token}}');
    }

}
