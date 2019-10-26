<?php


namespace frontend\controllers;

use Yii;

class JoinController extends BaseController
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