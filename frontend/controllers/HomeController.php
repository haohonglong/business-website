<?php


namespace frontend\controllers;

use frontend\models\NewsModule;
use yii;
use frontend\models\Banner;
use yii\web\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        $data = NewsModule::getArticleList(15);
        $banner = Banner::getBanners(29);
        return $this->render('index',[
            'banner'=>$banner,
            'article_list'=>$data,
        ]);
    }
}