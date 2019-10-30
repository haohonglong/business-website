<?php


namespace frontend\controllers;

use Yii;
use frontend\models\NewsModule;
use frontend\models\Article;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ComeController extends BaseController
{
    public function init(){
        parent::init();
        //这里取消token验证，为了ajax 可以访问，否则ajax 要带个token过来
        $this->enableCsrfValidation = false;
    }

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
    public function actionParty()
    {
        $article = Article::getContentByName('party')[0];
        return $this->render('party',[
            'list'=>$article,
        ]);
    }

    /**
     * 企业公民
     * @return string
     */
    public function actionCitizen()
    {

        $article = Article::getContentByName('citizen')[0];
        return $this->render('citizen',[
            'list'=>$article,
        ]);
    }



    /**
     *
     * @return string
     */
    public function actionChina()
    {

        if(Yii::$app->request->isAjax && Yii::$app->request->isPost){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $code = Yii::$app->request->post('province_code');
            $cities = $this->getCities($code);
            if($cities){
                $data = [
                    'status'=>'0',
                    'data'=>$cities,
                ];
            }else{
                $data = [
                    'status'=>'1',
                    'data'=>'获取数据失败',
                ];
            }
            return $data;
            exit;
        }else{
            $arr = (new Query())->select('province_code,province_name')->from('bs_province')->all();
            $arr = ArrayHelper::map($arr,'province_name','province_code');
            return $this->render('china',[
                'provinces'=>$arr,
            ]);
        }

    }

    private function getCities($code)
    {
        $arr = (new Query())->select('city_name,city_code')->from('bs_city')->where(['province_code'=>$code])->all();
        return $arr;
    }

}