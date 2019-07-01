<?php

namespace codexten\yii\modules\auth\models;

use Yii;
use yii\helpers\Url;
use \codexten\yii\db\ActiveRecord;
use \codexten\yii\modules\auth\models\query\RbacAuthItemChildQuery;

/**
 * This is the model class for table "{{%rbac_auth_item_child}}".
 *
 * Database fields:
 *
 * @property string $parent
 * @property string $child
 *
 * Defined properties:
 *
 * @property array $meta
 *
 * Defined relations:
 *
 * @property RbacAuthItem $parent0
 * @property RbacAuthItem $child0
 */
class RbacAuthItemChild extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rbac_auth_item_child}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::class, 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::class, 'targetAttribute' => ['child' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent' => Yii::t('app', 'Parent'),
            'child' => Yii::t('app', 'Child'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(RbacAuthItem::class, ['name' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(RbacAuthItem::class, ['name' => 'child']);
    }


    /**
     * {@inheritdoc}
     * @return RbacAuthItemChildQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacAuthItemChildQuery(get_called_class());
    }

}
