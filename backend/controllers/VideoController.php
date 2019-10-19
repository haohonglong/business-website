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
     * @auth - item group=视频中心 category=视频 description=视频列表  method=get,post
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearche();
        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());

        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }



    /**
     * @auth - item group=视频中心 category=视频 description=上传视频  method=get,post
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


    /**
     * @auth - item group=视频中心 category=视频 description=删除视频  method=get,post
     * @return array|Response
     * @throws BadRequestHttpException
     * @throws MethodNotAllowedHttpException
     * @throws UnprocessableEntityHttpException
     */
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

    /**
     * @auth - item group=视频中心 category=视频 description=显示  method=get,post
     * @param $id
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionViewLayer($id)
    {
        $model = VideoForm::findOne($id);
        if (! $model) throw new BadRequestHttpException(Yii::t('app', "Cannot find model by $id"));
        $model->setScenario('default');
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @auth - item group=视频中心 category=视频 description=排序  method=get,post
     * @return array|Response
     * @throws UnprocessableEntityHttpException
     */
    public function actionSort()
    {
        if (Yii::$app->getRequest()->getIsPost()) {
            $post = Yii::$app->getRequest()->post();
            if( isset( $post[Yii::$app->getRequest()->csrfParam] ) ) {
                unset($post[Yii::$app->getRequest()->csrfParam]);
            }
            $err = '';
            foreach ($post as $field => $array) {
                foreach ($array as $key => $value) {
                    /* @var $model \yii\db\ActiveRecord */

                    $model =  VideoForm::findOne($key);
                    $model->setScenario('default');
                    if ($model->$field != $value) {
                        $model->$field = $value;
                        if (!$model->save()) {
                            if( $err == '' ){
                                $err .= $key . ' : ';
                            }else{
                                $err .= '<br>' . $key . ' : ';
                            }
                            foreach ($model->getErrors() as $errorReason) {
                                $err .= $errorReason[0] . ';';
                            }
                        }
                    }
                }
            }
            $err = rtrim($err, ';');
            if (Yii::$app->getRequest()->getIsAjax()) {
                Yii::$app->getResponse()->format = Response::FORMAT_JSON;
                if( !empty($err) ){
                    throw new UnprocessableEntityHttpException($err);
                }else{
                    return [];
                }
            } else {
                if( !empty($err) ){
                    Yii::$app->getSession()->setFlash('error', $err);
                }
                return $this->goBack();
            }
        }
    }
}
