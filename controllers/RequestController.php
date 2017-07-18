<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use app\models\Request;

class RequestController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Request::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionGetwork($id)
    {
        $model = $this->findModel($id);
        $model->status = Request::STATUS_INWORK;
        $model->worked_by = Yii::$app->user->identity->getId();
        $model->save();
    }

    public function actionClose($id)
    {
        $model = $this->findModel($id);
        $model->status = Request::STATUS_CLOSED;
        $model->save();
    }

    public function actionCreate()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        //todo вставить уведомление что успешно удалено
        return $this->redirect(['index']);
    }

    public function actionUpdate()
    {
        return $this->render('index');
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
