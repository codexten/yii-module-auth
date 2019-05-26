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
    const TYPE_PHONE_NUMBER_VERIFICATION = 1;

    /**
     * @param int|null $userId
     *
     * @return UserToken|null
     */
    public static function generatePhoneNumberVerificationToken(int $userId = null)
    {
        return self::generateToken(self::TYPE_PHONE_NUMBER_VERIFICATION, $userId);
    }

    /**
     * @param int $type
     * @param int $userId
     *
     * @return UserToken|null
     */
    public static function generateToken(int $type, int $userId = null): ?UserToken
    {
        if ($userId === null) {
            $userId = UserHelper::getMyId();
        }

        $model = new UserToken();
        $model->type = $type;
        $model->user_id = $userId;

        $model->save();
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