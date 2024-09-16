<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $company_email;
    public $password;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['company_email', 'password'], 'required'],
            ['company_email', 'email', 'message' => 'Email is not a valid email address.'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    public function validatePassword($attribute, $params)
    {
        $user = $this->getUser();
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect email or password.');
        }
    }

    protected function getUser()
    {
        return User::findOne(['company_email' => $this->company_email]);
    }
}
