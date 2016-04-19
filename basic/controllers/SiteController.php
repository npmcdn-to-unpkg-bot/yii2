<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegForm;
use app\models\AccountActivation;
use app\models\User;
use app\models\SendEmailForm;
use yii\filters\VerbFilter;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

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
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['reg', 'login', 'activate-account'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['index', 'search', 'send', 'reset-password']
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionReg()
    {

        $model = new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            if ($user = $model->reg()):
                if ($user->status === User::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                else:
                    if ($model->sendActivationEmail($user)):
                        Yii::$app->session->setFlash('success', 'Letter sent to the activation email <strong>' . Html::encode($user->email) . '</strong>');
                    else:
                        Yii::$app->session->setFlash('error', 'Error. The letter was not sent.');
                        Yii::error('Error sending email.');
                    endif;
                    return $this->refresh();
                endif;
            else:
                Yii::$app->session->setFlash('error', 'An error occurred during registration.');
                Yii::error('Error registration');
                return $this->refresh();
            endif;
        endif;

        return $this->render(
            'reg',
            [
                'model' => $model
            ]
        );
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');

    }

    public function actionActivateAccount($key)
    {
        try {
            $user = new AccountActivation($key);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user->activateAccount()):
            Yii::$app->session->setFlash('success', 'Activation was successful. <strong>' . Html::encode($user->login) . '</strong>');
        else:
            Yii::$app->session->setFlash('error', 'Activation error.');
            Yii::error('Error activation.');
        endif;

        return $this->redirect(Url::to(['/site/login']));
    }

    public function actionSend()
    {
        $model = new SendEmailForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->sendEmail()):
                    Yii::$app->getSession()->setFlash('warning', 'Check email.');
                    return $this->goHome();
                else:
                    Yii::$app->getSession()->setFlash('error', 'You can not reset the password.');
                endif;
            }
        }

        return $this->render('sendEmail', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($key)
    {
        try {
            $model = new ResetPasswordForm($key);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->resetPassword()) {
                Yii::$app->getSession()->setFlash('warning', 'Password changed.');
                return $this->redirect(['/site/login']);
            }
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
