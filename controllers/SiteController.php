<?php

namespace app\controllers;

use app\components\Util;
use app\models\Cliente;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {
  /**
   * {@inheritdoc}
   */
  public function behaviors() {
    return [
      'access' => [
        'class' => AccessControl::class,
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
        'class' => VerbFilter::class,
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function actions() {
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
  public function actionIndex() {
    return $this->render('index');
  }

  /**
   * Login action.
   *
   * @return Response|string
   */
  public function actionLogin() {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }

    $model->password = '';
    return $this->render('login', [
      'model' => $model,
    ]);
  }

  /**
   * Logout action.
   *
   * @return Response
   */
  public function actionLogout() {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  /**
   * Displays contact page.
   *
   * @return Response|string
   */
  public function actionContact() {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');
      Util::procesarDatos();
      return $this->refresh();
    }
    return $this->render('contact', [
      'model' => $model,
    ]);
  }

  /**
   * Displays about page.
   *
   * @return string
   */
  public function actionAbout() {
    return $this->render('about');
  }

  public function actionPrueba() {
    $nombre = 'Emiliano Rodríguez';
    $paises = [
      [
        'nombre' => 'México',
        'foto' => 'https://blogs.unitec.mx/hubfs/Imported_Blog_Media/por-que-el-turismo-es-el-musculo-de-mexico-1-2.jpg#keepProtocol'
      ],
      [
        'nombre' => 'USA',
        'foto' => 'https://www.visittheusa.mx/sites/default/files/styles/hero_l/public/2016-10/About_the_USA_NYC_Statue_Liberty_._CROP_Web72DPI.jpg?itok=M7fJ8X6f'
      ],
      [
        'nombre' => 'Francia',
        'foto' => 'https://cdn.pixabay.com/photo/2018/04/25/09/26/eiffel-tower-3349075_640.jpg'
      ],
      [
        'nombre' => 'Japón',
        'foto' => 'https://res.cloudinary.com/jnto/image/upload/w_914,h_516,c_fill,f_auto,fl_lossy,q_60/v1/media/filer_public/c6/d2/c6d23c96-fc5d-42a4-8e36-0d852102367d/fushimi_lnwdef'
      ],
      [
        'nombre' => 'Corea',
        'foto' => 'https://www.shutterstock.com/image-photo/namsan-tower-pavilion-during-autumn-600nw-2345265717.jpg'
      ],
    ];
    return $this->render('prueba', [
      'nombreCompleto' => $nombre,
      'paises' => $paises
    ]);
  }

  public function actionFormulario() {
    $model = new Cliente();

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      return $this->redirect(['cliente-creado', 'nombre' => $model->nombre]);
    }

    return $this->render('formulario', ['model' => $model]);
  }

  public function actionClienteCreado($nombre) {
    return 'Se creó el cliente: ' . $nombre;
  }
}
