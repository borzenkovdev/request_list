<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use app\models\LoginForm;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionLogin()
    {
        $this->layout = 'login';

        if (! Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(
                Url::toRoute('request/index')
            );
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
