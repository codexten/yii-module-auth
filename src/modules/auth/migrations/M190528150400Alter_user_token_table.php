<?php

namespace codexten\yii\modules\auth\migrations;

use codexten\yii\modules\auth\models\UserToken;
use yii\db\Migration;

/**
 * Class M190528150400Alter_user_token_table
 */
class M190528150400Alter_user_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(UserToken::tableName(), 'expire_at', $this->integer());
        $this->alterColumn(UserToken::tableName(), 'type', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(UserToken::tableName(), 'type', $this->integer());
        $this->dropColumn(UserToken::tableName(), 'expire_at');
    }
}
