<?php


namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class JoinController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAt()
    {
        return $this->render('at');
    }
    public function actionCulture()
    {
        return $this->render('culture');
    }




}