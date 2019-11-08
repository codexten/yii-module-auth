<?php

namespace codexten\yii\modules\auth\models\query;

use \yii\db\ActiveQuery;
use \codexten\yii\modules\auth\models\RbacAuthItem;

/**
 * This is the ActiveQuery class for [[\codexten\yii\modules\auth\models\RbacAuthItem]].
 *
 * @see RbacAuthItem
 */
class RbacAuthItemQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return RbacAuthItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacAuthItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
