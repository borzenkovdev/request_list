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
        //fixme
        return true;
        if (parent::beforeAction($action)) {
            if (!Yii::$app->user->can($action->id)) {
                throw new ForbiddenHttpException('Access denied');
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}