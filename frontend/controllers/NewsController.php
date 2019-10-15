<?php


namespace frontend\controllers;


use frontend\models\NewsModule;
use yii\web\Controller;

class NewsController extends Controller
{

    public function actionIndex()
    {
        return $this->redirect('/news/group');
    }

    public function actionView()
    {
        return $this->render('view');

    }
    public function actionVideo()
    {
        return $this->render('video');
    }
    public function actionGroup()
    {
        $data = NewsModule::getArticleList(15);
        $first = array_shift($data);
        return $this->render('group',[
            'articles'=>$data,
            'art_first'=>$first,
        ]);
    }

    public function actionDynamic()
    {
        return $this->render('dynamic');
    }

    public function actionMedia()
    {
        return $this->render('media');
    }









}