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

            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => VideoForm::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => VideoForm::className(),
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

    public function actionUpdate($id)
    {
        $model = VideoForm::findOne($id);
        $videoUpload = new UploadVideoForm();
        if (Yii::$app->getRequest()->getIsPost()) {
            if ($model->load(Yii::$app->getRequest()->post())) {
                $videoUpload->url = UploadedFile::getInstance($videoUpload, 'url');
                if($videoUpload->upload()){
                    $model->url = $videoUpload->path.$videoUpload->name;
                    if( $model->create()){
                        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                        return $this->redirect('/video/index');
                    }
                }

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
            'video' => $videoUpload,
        ]);

    }
    public function actionCreate()
    {
        $model = new VideoForm();
        $model->uploadVideoForm = new UploadVideoForm();
        if (Yii::$app->getRequest()->getIsPost()) {
            if ($model->load(Yii::$app->getRequest()->post()) && $model->create()) {
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
}
