<?php
namespace frontend\controllers;

use common\models\Addresses;
use common\models\JobType;
use yii;

/**
 * 招聘
 * Class RecruitController
 */
class RecruitController extends BaseController
{
    public function actionIndex()
    {

        $jobTypes = JobType::getJobTypes();
        $addresses = Addresses::getAddresses();
        $arr = [];
        foreach ($jobTypes as $key => $item){
            $arr[] =[
                'id'=>$key,
                'name'=>$item,
            ];
        }
        $jobTypes = $arr;
        $arr = [];
        foreach ($addresses as $key => $item){
            $arr[] =[
                'id'=>$key,
                'name'=>$item,
            ];
        }
        $addresses = $arr;

        $rows = (new yii\db\Query())->select('id,jobtype_id,address_id,name,chain,duty,description,created_at')->from('jobs')->all();
        foreach ($rows as $key => $item){
            $rows[$key]['time'] = date('Y-m-d',$item['created_at']);
            unset($rows[$key]['created_at']);
        }

        return $this->render('index',[
            'jobTypes'=>json_encode($jobTypes,JSON_UNESCAPED_UNICODE),
            'addresses'=>json_encode($addresses,JSON_UNESCAPED_UNICODE),
            'list'=>$rows,
        ]);
    }
}