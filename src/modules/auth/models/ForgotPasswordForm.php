<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 29/12/18
 * Time: 10:31 AM
 */

namespace codexten\yii\modules\auth\models;


use Yii;
use yii\base\Model;

class ForgotPasswordForm extends Model
{
    public $username;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'validateUsername'],
        ];
    }

    public function validateUsername($attribute)
    {
        if ($this->user === null) {
            $this->addError($attribute, 'Invalid username');
        }
    }

    public function sendPassword()
    {
        $model = $this->getUser();
        $password = \Yii::$app->security->generateRandomString(8);
        $model->password_hash = \Yii::$app->security->generatePasswordHash($password);
        $model->save(false, ['password_hash']);

        return Yii::$app->mailer->compose()
            ->setFrom('info@giventake.world')
            ->setTo($model->email)
            ->setSubject('GiveNTake New Password ')
            ->setHtmlBody(Yii::$app->view->render('@codexten/mlm/member/module/user/mail/forgot-password',
                [
                    'username' => $model->username,
                    'password' => $password,
                ]))
            ->send();
    }

    /**
     * @return array|\codexten\yii\models\User|User|null
     */
    protected function getUser()
    {
        return User::find()->where([
            'or',
            ['username' => $this->username],
        ])->one();
    }
}