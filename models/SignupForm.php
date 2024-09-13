<?php

namespace app\models;

use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $name;
    public $company_name;
    public $company_email;
    public $password;
    public $role;

    public function rules()
    {
        return [
            [['name', 'company_name', 'company_email', 'password', 'role'], 'required'],
            ['company_email', 'email'],
            ['password', 'string', 'min' => 6],
            ['role', 'in', 'range' => ['admin', 'project_manager', 'user']], // Adjust roles as needed
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->company_name = $this->company_name;
        $user->company_email = $this->company_email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->role = $this->role; // Make sure role is properly assigned

        return $user->save() ? $user : null;
    }
}
