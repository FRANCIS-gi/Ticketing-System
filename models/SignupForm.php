<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $name;
    public $company_email;
    public $company_name;
    public $password;
    public $role;
    public $is_admin;

    public function rules()
    {
        return [
            [['name', 'company_email', 'company_name', 'password'], 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['company_email', 'email', 'message' => 'Email is not a valid email address.'],
            ['company_email', 'string', 'max' => 255],
            ['company_email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['company_name', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'message' => 'Password should contain at least 6 characters.'],
            ['role', 'in', 'range' => [User::ROLE_USER, User::ROLE_ADMIN]],
            ['role', 'default', 'value' => User::ROLE_USER],
            ['is_admin', 'boolean'],
            ['company_email', 'validatecompany_emailExists'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->company_email = $this->company_email;
        $user->company_name = $this->company_name;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->role = $this->is_admin ? User::ROLE_ADMIN : User::ROLE_USER;

        return $user->save() ? $user : null;
    }

    public function validatecompany_emailExists($attribute, $params)
    {
        if (User::find()->where(['company_email' => $this->company_email])->exists()) {
            $this->addError($attribute, 'This email address is already registered.');
        }
    }
}
