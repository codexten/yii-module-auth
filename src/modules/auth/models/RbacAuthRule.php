<?php

namespace codexten\yii\modules\auth\models;

use Yii;
use yii\helpers\Url;
use \codexten\yii\db\ActiveRecord;
use \codexten\yii\modules\auth\models\query\RbacAuthRuleQuery;

/**
 * This is the model class for table "{{%rbac_auth_rule}}".
 *
 * Database fields:
 *
 * @property string $name
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
 * @property RbacAuthItem[] $rbacAuthItems
 */
class RbacAuthRule extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rbac_auth_rule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAuthItems()
    {
        return $this->hasMany(RbacAuthItem::className(), ['rule_name' => 'name']);
    }


    /**
     * {@inheritdoc}
     * @return RbacAuthRuleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacAuthRuleQuery(get_called_class());
    }

}
