<?php

namespace app\components;

use Yii;
use yii\web\ForbiddenHttpException;

/**
 * Class Controller
 */
class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!Yii::$app->user->can($this->route)) {
                throw new ForbiddenHttpException('Access denied');
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}