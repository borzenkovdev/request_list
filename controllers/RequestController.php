<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use app\models\Request;
use app\models\RequestHistory;

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
        $dataProvider = new ActiveDataProvider([
            'query' => RequestHistory::find()->where(['request_id' => $id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetwork($id)
    {
        $model = $this->findModel($id);
        $model->status = Request::STATUS_INWORK;
        $model->worked_by = Yii::$app->user->identity->getId();
        if ($model->save()) {
            $modelHistory = new RequestHistory();
            $modelHistory->request_id = $id;
            $modelHistory->changed_by = Yii::$app->user->identity->getId();
            $modelHistory->description = 'Заявка переведена в статус "В работе"';
            $modelHistory->save();
            Yii::$app->session->addFlash('info', 'Заявка переведена в статус "В работе"');
            return $this->redirect(['index']);
        }
    }

    public function actionSendtoreview($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {
            $model->status = Request::STATUS_INREVIEW;
            if ( $model->update()) {
                $modelHistory = new RequestHistory();
                $modelHistory->request_id = $id;
                $modelHistory->changed_by = Yii::$app->user->identity->getId();
                $modelHistory->description = 'Заявка переведена в статус "На проверке"';
                $modelHistory->save();
                Yii::$app->session->addFlash('info', 'Заявка передана на проверку');
                return $this->redirect(['index']);
            }
        }

        return $this->render('sendtoreview');
    }

    public function actionClose($id)
    {
        $model = $this->findModel($id);
        $model->status = Request::STATUS_CLOSED;
        if ($model->update()) {
            $modelHistory = new RequestHistory();
            $modelHistory->request_id = $id;
            $modelHistory->changed_by = Yii::$app->user->identity->getId();
            $modelHistory->description = 'Заявка переведена в статус "Закрыта"';
            $modelHistory->save();
            Yii::$app->session->addFlash('info', 'Заявка переведена в статус "Закрыта"');
            return $this->redirect('index');
        }
    }

    public function actionCreate()
    {
        $model = new Request();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('info', 'Заявка успешно создана!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        //todo уведомление
        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('info', 'Заявка успешно обновлена!');
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $this->findModel($id),
        ]);
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
