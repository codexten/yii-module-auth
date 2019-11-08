<?php

namespace codexten\yii\modules\auth\models\query;

use \yii\db\ActiveQuery;
use \codexten\yii\modules\auth\models\RbacAuthItemChild;

/**
 * This is the ActiveQuery class for [[\codexten\yii\modules\auth\models\RbacAuthItemChild]].
 *
 * @see RbacAuthItemChild
 */
class RbacAuthItemChildQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return RbacAuthItemChild[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacAuthItemChild|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
