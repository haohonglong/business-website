<?php


namespace frontend\controllers;

use yii;
use frontend\models\NewsModule;
use frontend\models\Banner;

class HomeController extends BaseController
{
    public function actionIndex()
    {
        $data = NewsModule::getArticleList(15);
        return $this->render('index',[
            'article_list'=>$data,
        ]);
    }
}