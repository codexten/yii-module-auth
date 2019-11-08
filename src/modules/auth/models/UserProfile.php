<?php

namespace codexten\yii\modules\auth\models;

use Yii;
use yii\helpers\Url;
use \codexten\yii\db\ActiveRecord;
use \codexten\yii\modules\auth\models\query\UserProfileQuery;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * Database fields:
 *
 * @property int $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $phone_no
 */
class UserProfile extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'middle_name', 'last_name'], 'string', 'max' => 255],
            [['phone_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'phone_no' => Yii::t('app', 'Phone No'),
        ];
    }


    /**
     * {@inheritdoc}
     * @return UserProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserProfileQuery(get_called_class());
    }

}
