<?php

namespace app\controllers;

use Yii;
use app\components\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        return $this->render('index');
    }

    public function actionDelete()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        return $this->render('index');
    }
}
