<?php


namespace frontend\controllers;

use Yii;
use frontend\models\GuestbookForm;
use yii\web\Controller;

class ContactController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionReport()
    {
        return $this->render('report');
    }

    public function actionUs()
    {
        $model = new GuestbookForm();
        if(\Yii::$app->request->isPost){
            $model->attributes = \Yii::$app->request->post('GuestbookForm');
            $model->created_at = time();
            $model->updated_at = $model->created_at;
            if ($model->save()) {
                return $this->refresh();
            }else{
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $model->getErrors();
                exit;
            }
        }

        return $this->render('us', [
            'model' => $model,
        ]);
    }



}