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
        $query = Request::find();

        //вернуть заявки текущего пользователя
        if (Yii::$app->request->get() && $_GET['show'] == 'unfinished' ) {
            $query->andFilterWhere(['or',
                ['status' => Request::STATUS_INWORK], ['status' => Request::STATUS_INREVIEW]
            ]);
           $query->andFilterWhere(['worked_by' => Yii::$app->user->identity->getId()]);
        }

        //вернуть заявки по фильтру
        if (Yii::$app->request->get() && $_GET['show'] !== 'unfinished') {

            if  ($_GET['name'] && strlen($_GET['name']) > 0) {
                $query->andFilterWhere(['like', 'name', $_GET['name']]);
            }

            if  ($_GET['status'] && strlen($_GET['status']) > 0) {
                $query->andFilterWhere(['status' => Yii::$app->user->identity->getId()]);
            }

            if  ($_GET['created_from'] && strlen($_GET['created_from']) > 0) {
                $query->andFilterWhere(['>=', 'created_at', $_GET['created_from']]);
            }

            if  ($_GET['created_to'] && strlen($_GET['created_to']) > 0) {
                $query->andFilterWhere(['<=', 'created_at', $_GET['created_to']]);
            }

            if ($_GET['creator']  ||  $_GET['manager'] ) {
                $query->leftJoin('user',  'user.id=request.created_by');
            }

            if  ($_GET['creator'] && strlen($_GET['creator']) > 0) {
                $query->orWhere(['like', 'user.name', $_GET['creator']])
                    ->orWhere(['like', 'user.surname', $_GET['creator']])
                    ->orWhere(['like', 'user.middle_name', $_GET['creator']]);
            }

            if  ($_GET['manager'] && strlen($_GET['manager']) > 0) {
                $query->orWhere(['like', 'user.name', $_GET['manager']])
                    ->orWhere(['like', 'user.surname', $_GET['manager']])
                    ->orWhere(['like', 'user.middle_name', $_GET['manager']]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' =>
                ['attributes' => [
                    'id',
                    'name',
                    'workManager' => [
                        'asc' => ['worked_by' => SORT_ASC],
                        'desc' => ['worked_by' => SORT_DESC],
                        'default' => SORT_ASC
                    ],
                    'creator' =>  [
                        'asc' => ['created_by' => SORT_ASC],
                        'desc' => ['created_by' => SORT_DESC],
                        'default' => SORT_ASC
                    ],
                    'created_at',
                    'statusformatted' => [
                        'asc' => ['status' => SORT_ASC],
                        'desc' => ['status' => SORT_DESC],
                        'default' => SORT_ASC
                    ]
                ],
            ],
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
            if (strlen($model->result) > 0 &&  $model->update()) {
                $modelHistory = new RequestHistory();
                $modelHistory->request_id = $id;
                $modelHistory->changed_by = Yii::$app->user->identity->getId();
                $modelHistory->description = 'Заявка переведена в статус "На проверке"';
                $modelHistory->save();
                Yii::$app->session->addFlash('info', 'Заявка передана на проверку');
                return $this->redirect(['index']);
            }  else {
                $model->addError('result', 'Поле результат работы не может быть пустым!');
                print_r($model->getErrors());
                Yii::$app->session->addFlash('info', $model->errors);
                $this->refresh();
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
        if ($model->load(Yii::$app->request->post())) {
            if  ($model->save()) {
                Yii::$app->session->addFlash('info', 'Заявка успешно создана!');
                return $this->redirect(['view', 'id' => $model->id]);
            }  else {
                print_r($model->getErrors());
                Yii::$app->session->addFlash('info', $model->getErrors());
                $this->refresh();
            }
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

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->addFlash('info', 'Заявка успешно обновлена!');
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
                Yii::$app->session->addFlash('warning', $model->getErrors());
                $this->refresh();
            }
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
