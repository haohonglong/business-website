<?php


namespace frontend\controllers;

use frontend\models\NewsModule;
use Yii;
use yii\web\Controller;

class ComeController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 集团介绍
     * @return string
     */
    public function actionGroup()
    {
        return $this->render('group');
    }

    /**
     * 团队介绍
     * @return string
     */
    public function actionTeam()
    {
        return $this->render('team');
    }



    /**
     * 年志
     * @return string
     */
    public function actionMagazine()
    {
        return $this->render('magazine');
    }

    /**
     * 荣誉
     * @return string
     */
    public function actionGlory()
    {
        $data = NewsModule::getArticleList(16);
        return $this->render('glory',[
            'list'=>$data,
        ]);
    }

    /**
     * 党建
     * @return string
     */
    public function actionBuild()
    {
        return $this->render('build');
    }

    /**
     * 企业公民
     * @return string
     */
    public function actionCitizen()
    {
        return $this->render('citizen');
    }

    /**
     * 企业公民
     * @return string
     */
    public function actionChina()
    {
        return $this->render('china');
    }











}