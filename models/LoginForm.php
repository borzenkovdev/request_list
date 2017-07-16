<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username'], 'required', 'message' => 'Укажите логин, номер телефона или ваш емейл'],
            [['password'], 'required', 'message' => 'Введите ваш пароль'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин, емейл или телефон',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (isset($user->is_blocked) && $user->is_blocked) {
                $this->addError($attribute, 'Доступ заблокирован. Обратитесь к администрации.');
            }

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный логин или пароль.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            //$this->_user = User::find()->where(['email' => $this->username])->one();
            if ($this->isEmail()) {
                $this->_user = User::find()->where(['email' => $this->username])->one();
            } elseif ($this->isPhone()) {
                $this->_user = User::find()->where(['phone' => User::getStrongNumber($this->username)])->one();
            } else {
                $this->_user = User::find()->where(['login' => $this->username])->one();
            }
        }

        return $this->_user;
    }

    private function isPhone()
    {
        $number = preg_replace("/\D/", "", $this->username);
        if (strlen($number) > 9 && strlen($number) < 14) {
            return true;
        }

        return false;
    }

    private function isEmail()
    {
        if (filter_var($this->username, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}
