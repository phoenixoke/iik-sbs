<?php

namespace app\controllers;



use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FirstSignupForm;
use app\models\helpers\RecordHelper;

class SiteController extends Controller
{
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
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->render('index');
        }

        if(!RecordHelper::getAdminExistence()) {
            return $this->redirect(['first-signup']);
        } else {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * @return string|\yii\web\Response
     * controller to activate admin registration
     */
    public function actionFirstSignup(){
        if(!RecordHelper::getAdminExistence()) {
            $model = new FirstSignupForm();

            if ($model->load(Yii::$app->request->post())) {
                if ($user = $model->firstSignup()) {

                    //Profile

                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            }

            return $this->render('firstSignup', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    public function actionLogin(){
        return $this->redirect('index');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->getSession()->setFlash('success', 'You have succesfully signed out');
        return $this->goHome();
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
}
