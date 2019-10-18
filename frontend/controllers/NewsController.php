<?php


namespace frontend\controllers;

use Yii;
use frontend\models\NewsModule;
use yii\db\Query;
use yii\helpers\Url;
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

        $rows = (new \yii\db\Query())
            ->select('*')
            ->from('video')
            ->all();

        return $this->render('video',[
            'videos'=> $rows,
        ]);
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