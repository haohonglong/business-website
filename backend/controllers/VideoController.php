<?php

namespace backend\controllers;

use Yii;
use backend\models\search\VideoSearche;
use backend\models\form\VideoForm;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\Response;
use yii\web\UnprocessableEntityHttpException;
use yii\web\UploadedFile;
use common\models\UploadVideoForm;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends \yii\web\Controller
{
    /**
    * @auth
    * - item group=未分类 category=Videos description-get=列表 sort=000 method=get
    * - item group=未分类 category=Videos description-get=查看 sort=001 method=get  
    * - item group=未分类 category=Videos description=创建 sort-get=002 sort-post=003 method=get,post  
    * - item group=未分类 category=Videos description=修改 sort=004 sort-post=005 method=get,post  
    * - item group=未分类 category=Videos description-post=删除 sort=006 method=post  
    * - item group=未分类 category=Videos description-post=排序 sort=007 method=post  
    * @return array
    */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                    
                        $searchModel = new VideoSearche();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                        ];
                    
                }
            ],

            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => VideoForm::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => VideoForm::className(),
            ],
        ];
    }

    /**
     * @auth - item group=设置 category=Videos description-post=测试stmp设置 sort-post=112 method=post
     * @return string|Response
     */
    public function actionCreate()
    {

        $model = new VideoForm();
        $model->uploadVideoForm = new UploadVideoForm();
        if (Yii::$app->getRequest()->getIsPost()) {
            if ($model->load(Yii::$app->getRequest()->post()) && $model->upload($model->uploadVideoForm) && $model->create()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect('/video/index');
            }
            $errorReasons = $model->getErrors();
            $err = '';
            foreach ($errorReasons as $errorReason) {
                $err .= $errorReason[0] . '<br>';
            }
            $err = rtrim($err, '<br>');
            Yii::$app->getSession()->setFlash('error', $err);
        }
        return $this->render('create',[
            'model' => $model,
        ]);
    }

    public function actionDelete()
    {
        if (Yii::$app->getRequest()->getIsPost()) {//只允许post删除
            $id = Yii::$app->getRequest()->get('id', null);
            $param = Yii::$app->getRequest()->post('id', null);
            if($param !== null){
                $id = $param;
            }

            if( Yii::$app->getRequest()->getIsAjax() ){
                Yii::$app->getResponse()->format = Response::FORMAT_JSON;
            }
            if (! $id) {
                throw new BadRequestHttpException(Yii::t('app', "id doesn't exist"));
            }
            $ids = explode(',', $id);
            $errors = [];
            /* @var $model \yii\db\ActiveRecord */
            $model = null;
            (new VideoForm())->remove($ids);
            if (count($errors) == 0) {
                if( !Yii::$app->getRequest()->getIsAjax() ) return $this->redirect(Yii::$app->getRequest()->getReferrer());
                return [];
            } else {
                $err = '';
                foreach ($errors as $one => $model){
                    $err .= $one . ':';
                    $errorReasons = $model->getErrors();
                    foreach ($errorReasons as $errorReason) {
                        $err .= $errorReason[0] . ';';
                    }
                    $err = rtrim($err, ';') . '<br>';
                }
                $err = rtrim($err, '<br>');
                throw new UnprocessableEntityHttpException($err);
            }
        } else {
            throw new MethodNotAllowedHttpException(Yii::t('app', "Delete must be POST http method"));
        }
    }
}
