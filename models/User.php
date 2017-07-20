<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $middle_name
 * @property string $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ROLE_GUEST = 'guest';
    const ROLE_USER  = 'user';
    const ROLE_ADMIN = 'admin';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password'], 'required', 'message' => "Поле Пароль не может быть пустым"],
            [['login'], 'required', 'message' => "Поле Ник не может быть пустым"],
            [['login'], 'validateLogin'],
            [['login', 'password', 'name', 'surname', 'middle_name'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'name' => 'Name',
            'surname' => 'Surname',
            'middle_name' => 'Middle Name',
            'role' => 'Role',
            'salt' => 'salt',
        ];
    }

    public function validateLogin($attribute, $params)
    {
        $login_without_digits = trim(preg_replace("/[0-9]+/", "", $this->$attribute));

        if (0 == strlen($login_without_digits)) {
            $this->addError($attribute, 'В поле Логин обязательны латинские буквы');
        }
    }

    public function validatePassword($password)
    {
        return $this->password === $this->hashPassword($password);
    }

    public function hashPassword($password)
    {
        return md5(md5($password) . $this->salt);
    }

    public function generateSalt()
    {
        return substr(uniqid('', true), 0, 10);
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNameFormatted()
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->middle_name;
    }

    public function getRole()
    {
        return $this->role;
    }
}
