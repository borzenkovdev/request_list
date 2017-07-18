<?php

use yii\db\Migration;
use app\models\User;

class m170716_133902_add_users extends Migration
{
    public function up()
    {
        $model = new User();

        $users = [
            [
                'login' => 'admin',
                'password' => '1qaz!QAZ',
                'name' => 'Иван',
                'surname' => 'Андреевич',
                'middle_name' => 'Летов',
                'role' => 'admin',
            ],
            [
                'login' => 'manager',
                'password' => '12345',
                'name' => 'Денис',
                'surname' => 'Сергеевич',
                'middle_name' => 'Абармов',
                'role' => 'user',
            ]
        ];

        foreach($users as $user) {
            $salt = $model->generateSalt();
            $model->login = $user['login'];
            $model->password =  md5(md5($user['password']) . $salt);
            $model->name = $user['name'];
            $model->surname = $user['surname'];
            $model->middle_name = $user['middle_name'];
            $model->role = $user['role'];
            $model->salt = $salt;
            $model->save();
        }


    }

    public function down()
    {
        echo "m170716_133902_add_users cannot be reverted.\n";
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
