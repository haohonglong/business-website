<?php


namespace frontend\controllers;

use common\models\Article;
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

        $article = (new \yii\db\Query())
            ->select(['id','title', 'summary'])
            ->from('article')
            ->where(['id' => '42','status'=>Article::ARTICLE_PUBLISHED])
            ->limit(1)
            ->one();
        $images = (new \yii\db\Query())
            ->select(['value'])
            ->from('article_meta')
            ->where(['aid' => '42'])
            ->all();

        $arr = [];
        foreach ($images as $v){
            $arr[] = $v['value'];
        }
        $article['images'] = $arr;
        return $this->render('citizen',[
            'list'=>$article,
        ]);
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