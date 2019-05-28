<?php

namespace codexten\yii\modules\auth\helpers;


use codexten\yii\modules\auth\models\UserToken;

/**
 * Class UserTokenHelper
 *
 * @package codexten\yii\modules\auth\helpers
 */
class UserTokenHelper
{
    const TYPE_PHONE_NUMBER_VERIFICATION = 'mobile_verification';

    /**
     * @param string $code
     * @param int $duration
     *
     * @param int|null $userId
     *
     * @return UserToken|null
     */
    public static function generatePhoneNumberVerificationToken(
        string $code = null,
        int $duration = 3600,
        int $userId = null
    ) {
        if ($code === null) {
            $code = rand(11111, 99999);
        }

        return self::generateToken(self::TYPE_PHONE_NUMBER_VERIFICATION, $code, $duration, $userId);
    }

    /**
     * @param string $type
     * @param string|null $code
     * @param int $duration
     * @param int $userId
     *
     * @return UserToken|null
     */
    public static function generateToken(
        string $type,
        string $code = null,
        int $duration = 3600,
        int $userId = null
    ): ?UserToken {
        if ($userId === null) {
            $userId = UserHelper::getMyId();
        }

        $model = new UserToken();
        $model->type = $type;
        $model->code = $code;
        $model->user_id = $userId;
        $model->expire_at = time() + $duration;

        return $model->save() ? $model : null;
    }

    public function getToken(string $type, int $userId = null)
    {
        if ($userId === null) {
            $userId = UserHelper::getMyId();
        }

        return UserToken::find()->byType($type)->byToken($userId)->notExpired()->one();
    }

    /**
     * @param string $code
     * @param int $type
     * @param int|null $userId
     *
     * @return UserToken|null
     */
    public function getUserTokenByCode(string $code, int $type, int $userId = null): ?UserToken
    {
        if ($userId === null) {
            $userId = UserHelper::getMyId();
        }

        return UserToken::findOne(['code' => $code, 'type' => $type, 'user_id' => $userId]);
    }
}