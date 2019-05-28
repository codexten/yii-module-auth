<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace codexten\yii\modules\auth\models;

use codexten\yii\db\ActiveRecord;
use codexten\yii\modules\auth\models\query\UserTokenQuery;
use codexten\yii\modules\auth\traits\ModuleTrait;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Url;

/**
 * Token Active Record model.
 *
 * @property integer $user_id
 * @property string $code
 * @property integer $created_at
 * @property integer $expire_at
 * @property integer $type
 * @property string $url
 * @property bool $isExpired
 * @property User $user
 *
 * @author Jomon Johnson <cto@codexten.com>
 */
class UserToken extends ActiveRecord
{
//    use ModuleTrait;

//    const TYPE_CONFIRMATION = 1;
//    const TYPE_RECOVERY = 2;
//    const TYPE_CONFIRM_NEW_EMAIL = 3;
//    const TYPE_CONFIRM_OLD_EMAIL = 4;
//    const TYPE_OTP_VERIFICATION = 5;


    /** @inheritdoc */
    public static function tableName()
    {
        return '{{%user_token}}';
    }

    /** @inheritdoc */
    public static function primaryKey()
    {
        return ['user_id', 'code', 'type'];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

//    /**
//     * @return string
//     */
//    public function getUrl()
//    {
//        switch ($this->type) {
//            case self::TYPE_CONFIRMATION:
//                $route = '/user/registration/confirm';
//                break;
//            case self::TYPE_RECOVERY:
//                $route = '/user/recovery/reset';
//                break;
//            case self::TYPE_CONFIRM_NEW_EMAIL:
//            case self::TYPE_CONFIRM_OLD_EMAIL:
//                $route = '/user/settings/confirm';
//                break;
//            default:
//                throw new \RuntimeException();
//        }
//
//        return Url::to([$route, 'id' => $this->user_id, 'code' => $this->code], true);
//    }
//
//    /**
//     * @return bool Whether token has expired.
//     */
//    public function getIsExpired()
//    {
//        switch ($this->type) {
//            case self::TYPE_CONFIRMATION:
//            case self::TYPE_CONFIRM_NEW_EMAIL:
//            case self::TYPE_CONFIRM_OLD_EMAIL:
//                $expirationTime = $this->module->confirmWithin;
//                break;
//            case self::TYPE_RECOVERY:
//                $expirationTime = $this->module->recoverWithin;
//                break;
//            default:
//                throw new \RuntimeException();
//        }
//
//        return ($this->created_at + $expirationTime) < time();
//    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            static::deleteAll(['user_id' => $this->user_id, 'type' => $this->type]);
            if ($this->code === null) {
                $this->setAttribute('code', Yii::$app->security->generateRandomString());
            }
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return UserTokenQuery
     */
    public static function find()
    {
        return new UserTokenQuery(get_called_class());
    }
}
