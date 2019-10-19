<?php

namespace backend\controllers;

use Yii;
use backend\models\GuestSearche;
use common\models\Guestbook;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;

/**
 * GuestbookController implements the CRUD actions for Guestbook model.
 */
class GuestbookController extends \yii\web\Controller
{
    /**
    * @auth
    * - item group=留言板 category=留言板 description=列表 method=get,post
    * - item group=留言板 category=留言板 description=删除 method=get,post  
    * - item group=留言板 category=留言板 description=排序 method=get,post  
    * - item group=留言板 category=留言板 description=查看 method=get,post
    * @return array
    */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                    
                        $searchModel = new GuestSearche();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                        ];
                    
                }
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Guestbook::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Guestbook::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => Guestbook::className(),
            ],
        ];
    }
}
