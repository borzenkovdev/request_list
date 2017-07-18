<?php

namespace app\components;

use Yii;
use yii\rbac\Rule;
use app\models\User;

class UserRoleRule extends Rule
{
    public $name = __CLASS__;
    
    public function execute($user, $item, $params)
    {
        $role = (Yii::$app->user->isGuest === false)
            ? Yii::$app->user->identity->role
            : User::ROLE_GUEST;

      return $role == $item->name;
    }
}
