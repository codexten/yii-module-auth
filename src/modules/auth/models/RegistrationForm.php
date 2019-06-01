<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 10/12/18
 * Time: 8:47 PM
 */

namespace codexten\yii\modules\auth\models;

use codexten\yii\modules\auth\traits\ModuleTrait;
use Throwable;
use Yii;
use yii\base\Model;
use yii\db\Exception;

/**
 * Registration form collects user input on registration process, validates it and creates new User model.
 */
class RegistrationForm extends Model
{
    use ModuleTrait;

    /**
     * @var string User email address
     */
    public $email;
    /**
     * @var string Username
     */
    public $username;
    /**
     * @var string Password
     */
    public $password;

    public $roles = [];

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username rules
            'usernameTrim' => ['username', 'trim'],
            'usernameLength' => ['username', 'string', 'min' => 3, 'max' => 255],
//            'usernamePattern' => ['username', 'match', 'pattern' => $user::$usernameRegexp],
            'usernameRequired' => ['username', 'required'],
            'usernameUnique' => [
                'username',
                'unique',
                'targetClass' => User::class,
                'message' => Yii::t('codexten:user', 'This username has already been taken'),
            ],
            // email rules
            'emailTrim' => ['email', 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
            'emailUnique' => [
                'email',
                'unique',
                'targetClass' => User::class,
                'message' => Yii::t('codexten:user', 'This email address has already been taken'),
            ],
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            'passwordLength' => ['password', 'string', 'min' => 6, 'max' => 72],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('codexten:user', 'Email'),
            'username' => Yii::t('codexten:user', 'Username'),
            'password' => Yii::t('codexten:user', 'Password'),
        ];
    }

    /**
     * @return User;
     */
    public function getUser()
    {
        return $this->_user;
    }

    protected function createUserAccount()
    {
        $model = Yii::createObject(['class' => User::class]);
        $model->username = $this->username;
        $model->password = $this->password;
        $model->email = $this->email;
        if ($model->save()) {
            $this->_user = $model;

            return true;
        }

        return false;
    }

    protected function assignRoles()
    {
        $authManager = Yii::$app->authManager;
        $authManager->revokeAll($this->getUser()->id);
        foreach ($this->roles as $roleName) {
            $role = $authManager->getRole($roleName);
            if ($role === null) {
                $role = $authManager->createRole($roleName);
            }
            if (!$authManager->assign($role, $this->getUser()->id)) {
                return false;
            }
        }

        return true;
    }

    protected function beforeSave()
    {
        return true;
    }

    protected function afterSave()
    {
        return true;
    }

    /**
     * Registers a new user account.
     *
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$this->beforeSave()) {
                throw new Exception("Trigger transaction rollback");
            }
            if (!$this->createUserAccount()) {
                throw new Exception("Trigger transaction rollback");
            }
            if (!$this->assignRoles()) {
                throw new Exception("Trigger transaction rollback");
            }
            if (!$this->afterSave()) {
                throw new Exception("Trigger transaction rollback");
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * Loads attributes to the user model. You should override this method if you are going to add new fields to the
     * registration form. You can read more in special guide.
     *
     * By default this method set all attributes of this model to the attributes of User model, so you should properly
     * configure safe attributes of your User model.
     *
     * @param User $user
     */
    protected function loadAttributes(User $user)
    {
        $user->setAttributes($this->attributes);
    }
}
