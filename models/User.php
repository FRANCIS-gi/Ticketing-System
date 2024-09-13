<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class User extends ActiveRecord implements IdentityInterface
{
    public $is_admin;
    public $userType; // Virtual attribute

    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['admin-page'], // The actions that require role-based access
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Only logged-in users
                        'matchCallback' => function ($rule, $action) {
                            return in_array(Yii::$app->user->identity->role, ['project_manager', 'ceo']);
                        },
                    ],
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'company_name', 'company_email', 'password_hash'], 'required'],
            ['company_email', 'email'],
            ['company_email', 'unique'],
            ['role', 'in', 'range' => ['user', 'project_manager', 'ceo']], // Define allowed roles
            ['password_hash', 'string', 'min' => 6],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['auth_key', 'access_token'], 'string'],
        ];
    }

    public static function findByCompanyEmail($email)
    {
        return static::findOne(['company_email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public static function isUserAdmin($email)
    {
        return static::findOne(['email' => $email, 'role' => self::ROLE_ADMIN]) !== null;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
                $this->access_token = Yii::$app->security->generateRandomString(40);
            }
            return true;
        }
        return false;
    }

    public function getIsAdmin()
    {
        return $this->is_admin == 1; // Returns true if the user is an admin
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getCompanyEmail()
    {
        return $this->company_email; // Ensure 'company_email' exists in the database
    }
}
