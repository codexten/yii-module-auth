<?php

namespace codexten\yii\modules\auth\models\query;

use \yii\db\ActiveQuery;
use \codexten\yii\modules\auth\models\RbacAuthRule;

/**
 * This is the ActiveQuery class for [[\codexten\yii\modules\auth\models\RbacAuthRule]].
 *
 * @see RbacAuthRule
 */
class RbacAuthRuleQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return RbacAuthRule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacAuthRule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
