<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * 招聘
 * Class RecruitController
 */
class RecruitController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}