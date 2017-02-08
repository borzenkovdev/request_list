<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
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
        $qusetionsData = [];

        $query = Yii::$app->request->get('query');

        if (strlen($query) > 0) {
            $session = Yii::$app->session;
            if (! $session->isActive) {
                $session->open();
            }
            $session->set('stackoverflow_query', $query);
            $qusetionsData = $this->getQuestionsFromStackoverflow($query);
        }

        $provider = new ArrayDataProvider([
            'allModels' => $qusetionsData['items'],
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort' => [
                'attributes' => ['creation_date'],
            ],
        ]);

        return $this->render('questions', [
            'dataProvider' => $provider
        ]);
    }

    /**
     * @param $query
     * @return bool|mixed
     */
    private function getQuestionsFromStackoverflow($query) {
        if(strlen($query) > 0 && $ch = curl_init() ) {

            $dataQuery = [
                'order'=>'desc',
                'sort'=>'creation',
                'q'=> $query,
                'site'=>'stackoverflow',
            ];

            $buildedQuery = http_build_query($dataQuery);

            $apiUrl = "https://api.stackexchange.com/2.2/search/advanced?{$buildedQuery}";

            // set url
            curl_setopt($ch, CURLOPT_URL, $apiUrl);

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_ENCODING ,"UTF-8");

            // $output contains the output string
            if (! $output = curl_exec($ch)) {
                Yii::error('curl error:' . curl_error($ch));
            }
            // close curl resource to free up system resources
            curl_close($ch);

            return json_decode($output, true);
        } else {
            return false;
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
