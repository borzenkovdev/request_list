<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\base\ErrorException;

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
     * Displays questions list.
     *
     * @return string
     */
    public function actionQuestions()
    {
        $query = Yii::$app->request->get('query');
        if (strlen($query) > 0) {
            Yii::$app->session->set('stackoverflow_query', $query);
            $questionsData = $this->getQuestionsFromStackoverflow($query);
        }

        $provider = new ArrayDataProvider([
            'allModels' => $questionsData,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'attributes' => ['creation_date'],
            ],
        ]);

        return $this->render('questions', [
            'dataProvider' => $provider,
            'findedQestitonsQuantity' => count($questionsData)
        ]);
    }

    /**
     * @param $query
     * @return array|string
     */
    private function getQuestionsFromStackoverflow($query) {
        if(strlen($query) > 0 ) {
            $dataQuery = [
                'order'=>'desc',
                'sort'=>'creation',
                'q'=> $query,
                'site'=>'stackoverflow',
            ];
            $buildedQuery = http_build_query($dataQuery);
            $apiUrl = "https://api.stackexchange.com/2.2/search/advanced?{$buildedQuery}";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING ,"UTF-8");

            if (! $output = curl_exec($ch)) {
                Yii::error('curl error:' . curl_error($ch));
                curl_close($ch);
                return $this->render(
                    'error',
                    ['message' => 'The above error occurred while the Web server was processing your request.']
                );
            }
            // close curl resource to free up system resources
            curl_close($ch);
            $result = json_decode($output, true);
            if ($result['quota_remaining'] == 0 && count($result['items']) == 0) {
                return $this->render(
                    'error',
                    ['message' => 'Reached limit of requests']
                );
            }
            if ($result && isset($result['items'])) {
                return $result['items'];
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
