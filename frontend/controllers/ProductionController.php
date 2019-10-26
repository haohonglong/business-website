<?php


namespace frontend\controllers;

use frontend\models\Article;
use Yii;

class ProductionController extends BaseController
{



    public function actionIndex()
    {
        $request = Yii::$app->request;
        $id = $request->get('id','18');
        $page = $request->get('page','1');
        $page_size = $request->get('pageSize','10');

        $arr = Article::getList($id,$page,$page_size);

        return $this->render('index',[
            'list'=>$arr['models'],
        ]);
    }







}