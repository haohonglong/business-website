<?php

namespace backend\controllers;

use Yii;
use backend\models\search\addressesSearche;
use common\models\Addresses;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;

/**
 * AddressesController implements the CRUD actions for Addresses model.
 */
class AddressesController extends \yii\web\Controller
{
    /**
    * @auth
    * - item group=应聘管理 category=地址管理 description=列表 method=get,post
    * - item group=应聘管理 category=地址管理 description=创建  method=get,post  
    * - item group=应聘管理 category=地址管理 description=修改 method=get,post  
    * - item group=应聘管理 category=地址管理 description-post=删除 method=post  
    * - item group=应聘管理 category=地址管理 description=排序 method=get,post  
    * - item group=应聘管理 category=地址管理 description-get=查看 method=get  
    * @return array
    */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                        $searchModel = new addressesSearche();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                        ];
                    
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Addresses::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Addresses::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Addresses::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Addresses::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => Addresses::className(),
            ],
        ];
    }
}
