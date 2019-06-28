<?php

namespace codexten\yii\modules\auth\models;

use Yii;
use yii\helpers\Url;
use \codexten\yii\db\ActiveRecord;
use \codexten\yii\modules\auth\models\query\RbacAuthItemQuery;

/**
 * This is the model class for table "{{%rbac_auth_item}}".
 *
 * Database fields:
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * Defined properties:
 *
 * @property array $meta
 *
 * Defined relations:
 *
 * @property RbacAuthAssignment[] $rbacAuthAssignments
 * @property RbacAuthRule $ruleName
 * @property RbacAuthItemChild[] $rbacAuthItemChildren
 * @property RbacAuthItemChild[] $rbacAuthItemChildren0
 * @property RbacAuthItem[] $children
 * @property RbacAuthItem[] $parents
 */
class RbacAuthItem extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rbac_auth_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthRule::class, 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAuthAssignments()
    {
        return $this->hasMany(RbacAuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(RbacAuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAuthItemChildren()
    {
        return $this->hasMany(RbacAuthItemChild::className(), ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAuthItemChildren0()
    {
        return $this->hasMany(RbacAuthItemChild::className(), ['child' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(RbacAuthItem::className(), ['name' => 'child'])->viaTable('{{%rbac_auth_item_child}}', ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(RbacAuthItem::className(), ['name' => 'parent'])->viaTable('{{%rbac_auth_item_child}}', ['child' => 'name']);
    }


    /**
     * {@inheritdoc}
     * @return RbacAuthItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacAuthItemQuery(get_called_class());
    }

}
