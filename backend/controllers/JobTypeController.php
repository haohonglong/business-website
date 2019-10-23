<?php

namespace backend\controllers;

use Yii;
use backend\models\search\JobTypeSearche;
use common\models\jobType;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;

/**
 * JobTypeController implements the CRUD actions for jobType model.
 */
class JobTypeController extends \yii\web\Controller
{
    /**
    * @auth
     * - item group=应聘管理 category=管理职能类型 description=列表 method=get,post
     * - item group=应聘管理 category=管理职能类型 description=创建  method=get,post  
     * - item group=应聘管理 category=管理职能类型 description=修改 method=get,post  
     * - item group=应聘管理 category=管理职能类型 description-post=删除 method=post  
     * - item group=应聘管理 category=管理职能类型 description=排序 method=get,post  
     * - item group=应聘管理 category=管理职能类型 description-get=查看 method=get  
    * @return array
    */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                    
                        $searchModel = new JobTypeSearche();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                        ];
                    
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => jobType::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => jobType::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => jobType::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => jobType::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => jobType::className(),
            ],
        ];
    }
}
