<?php

namespace backend\controllers;

use common\models\Addresses;
use common\models\JobType;
use Yii;
use backend\models\search\JobsSearche;
use backend\models\form\JobsForm;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;

/**
 * JobsController implements the CRUD actions for JobsForm model.
 */
class JobsController extends \yii\web\Controller
{
    /**
    * @auth
     * - item group=应聘管理 category=管理应聘信息 description=列表 method=get,post
     * - item group=应聘管理 category=管理应聘信息 description=创建  method=get,post  
     * - item group=应聘管理 category=管理应聘信息 description=修改 method=get,post  
     * - item group=应聘管理 category=管理应聘信息 description-post=删除 method=post  
     * - item group=应聘管理 category=管理应聘信息 description=排序 method=get,post  
     * - item group=应聘管理 category=管理应聘信息 description-get=查看 method=get  
    * @return array
    */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                        $jobTypes = JobType::getJobTypes();
                        $addresses = Addresses::getAddresses();

                        $searchModel = new JobsSearche();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                            'jobTypes' => $jobTypes,
                            'addresses' => $addresses,
                        ];
                    
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => JobsForm::className(),
                'data' => function($model){
                    $jobTypes = JobType::getJobTypes();
                    $addresses = Addresses::getAddresses();
                    return [
                        'model'=>$model,
                        'jobTypes' => $jobTypes,
                        'addresses' => $addresses,
                    ];

                }
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => JobsForm::className(),
                'data' => function($model){
                    $jobTypes = JobType::getJobTypes();
                    $addresses = Addresses::getAddresses();
                    return [
                        'model'=>$model,
                        'jobTypes' => $jobTypes,
                        'addresses' => $addresses,
                    ];

                }
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => JobsForm::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => JobsForm::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => JobsForm::className(),
            ],
        ];
    }
}
