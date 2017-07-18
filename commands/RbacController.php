<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;
use app\components\UserRoleRule;


/**
 * Class RbacController
 */
class RbacController extends Controller
{
    protected $manager;
    protected $roleRule;

    public function __construct($id, $module, $config = array())
    {
        $this->manager = Yii::$app->authManager;
        $this->roleRule = new UserRoleRule;

        parent::__construct($id, $module, $config);
    }

    public function getRoles()
    {
        return [
            User::ROLE_GUEST => [
                'ruleName'    => $this->roleRule->name,
                'permissions' => $this->guestPermissions,
            ],
            User::ROLE_USER => [
                'ruleName'    => $this->roleRule->name,
                'permissions' => $this->userPermissions,
            ],
            User::ROLE_ADMIN => [
                'ruleName'    => $this->roleRule->name,
                'permissions' => $this->adminPermissions,
            ],
        ];
    }

    public function getGuestPermissions()
    {
        return [
            'site/index',
            'site/error',
            'site/login',
            'site/logout',
        ];
    }

    public function getUserPermissions()
    {
        return array_merge([
            'request/index',
            'request/view',
            'request/create',
        ], $this->guestPermissions);
    }

    public function getAdminPermissions()
    {
        return array_merge([
            'request/update',
            'request/delete',
        ], $this->userPermissions);
    }

    public function actionInit()
    {
        $this->manager->removeAll();
        $this->manager->add($this->roleRule);
        $this->createPermissions();
    }

    protected function createPermissions()
    {
        // permission Guest
        $this->createPermission('site/index');
        $this->createPermission('site/error');
        $this->createPermission('site/login');
        $this->createPermission('site/logout');

        // permission User
        $this->createPermission('request/index');
        $this->createPermission('request/view');
        $this->createPermission('request/create');

        // permission Admin
        $this->createPermission('request/update');
        $this->createPermission('request/delete');

        $this->createRoles();
    }

    protected function createPermission($name, $ruleName = null, $description = null)
    {
        $permission = $this->manager->createPermission($name);
        $permission->ruleName = $ruleName;
        $permission->description = $description;
        $this->manager->add($permission);
    }

    protected function createRoles()
    {
        foreach ($this->roles as $index => $value) {
            echo "\nCreate Role: {$index}\n";
            $role = $this->manager->createRole($index);
            $role->name = $index;
            $role->ruleName = $value['ruleName'];

            $this->manager->add($role);

            foreach ($value['permissions'] as $permission) {
                echo "*** Permission: {$permission}\n";
                $permission = $this->manager->getPermission($permission);
                $this->manager->addChild($role, $permission);
            }
        }
    }
}
