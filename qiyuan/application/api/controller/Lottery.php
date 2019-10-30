<?php
namespace app\api\controller;
use app\api\model\Order as Od;
use app\api\model\OrderComment as OdComment;
use app\api\model\ProductLottery;
use app\api\model\ProductLotteryUser;
use app\api\model\Resource;
use app\api\model\ResourceProduct;
use app\api\model\ResourceProductLottery;
use library\Helper;
use think\Cache;
use think\Request;
use think\Db;

class Lottery
{
    public function detail()
    {
        $request = Request::instance();
        $appId = $request->param('appId', '');
        $userSession = $request->param('userSession', '');
        $id = $request->param('gid', '', 'intval');
        $lid = $request->param('lid', '', 'intval');

        $userData = Cache::get($userSession);
        $uid = $userData['userInfo']['uid'];

        $where = array(
            'id' => $id,
            'appid' => $appId
        );

        $returnData['goods'] = Resource::where($where)->field('id, title, price, goodssort, summary')->find();

        if(!$returnData['goods']) {
            return [
                'code' => 1,
                'msg' => '抽奖活动不存在'
            ];
        }

        $gid = $returnData['goods']['id'];
        $where = [
            'rid' => $gid,
        ];    

        $countproductlottery = ProductLottery::where(['appid'=>$appId,'rid'=>$gid])->count();

        $returnData['comment'] = ResourceProduct::where($where)->field('description, pic, ppic')->find();
        
        $returnData['coverList'] = json_decode($returnData['comment']['pic'], TRUE);
        $returnData['pcoverList'] = json_decode($returnData['comment']['ppic'], TRUE);
        
        $returnData['comment']['description'] = Helper::replaceRichText($returnData['comment']['description']);

        $returnData['lottery'] = ResourceProductLottery::where($where)->field('id,joinnum, endtime, totalnum, pricenum, status, update_time')->find();

        $endtime = date("Y-m-d H:i", $returnData['lottery']['endtime']);

        $returnData['lottery']['endtime'] = str_replace("-","/",$endtime);

        $returnData['lottery']['opentime'] = date("m月d日", (int)$returnData['lottery']['endtime']);
        $returnData['lottery']['updatetime'] = date("m月d日", (int) strtotime($returnData['lottery']['update_time']));

        if($lid) {

            $where = array(
                'lid' => $lid,
                'appid' => $appId,
                'uid' => $uid
            );

            $returnData['isHelp'] = ProductLotteryUser::where($where)->field('uid')->find();

            $returnData['isJoin'] = $this->isJoin($gid, $uid, $lid);

            $productLotteryWhere = [
                'id' => $lid,
            ];

        } else {
            $productLotteryWhere = [
                'uid'=>$uid,
                'appid'=>$appId,
                'rid'=>$gid
            ];
            $returnData['isJoin'] = $this->isJoin($gid, $uid);
        }

        $productlottery = ProductLottery::where($productLotteryWhere)->field('id,uid, joinnum, status, isprize')->order('id desc')->find();

        $where = array(
            'lid' => $productlottery['id'],
            'founderuid' => $productlottery['uid'],
        );

        $returnData['joinUserList'] = ProductLotteryUser::where($where)->order('id')->limit(5)->field('avatar')->select();

        if (count($returnData['joinUserList']) < 5) {

            for($i = count($returnData['joinUserList']); $i < 5; $i++) {
                $returnData['joinUserList'][$i]['avatar'] = '';
            }
        }
        
        $returnData['joinnum'] = $productlottery['joinnum'] ? $productlottery['joinnum'] : 0;
        $returnData['sum'] = $countproductlottery ? $countproductlottery : 0;
        
        $topUserLotteryList = $userLotteryList = [];
        //返回中奖列表
        if ($returnData['lottery']['status'] == 1) {
            $userLotteryList = ProductLottery::with('user')->where(['rid' => $gid, 'status' => 1, 'isprize' => 1])->order('id')->select();
        
            /*$topUserLotteryList = [
                isset($userLotteryList[0]) ? $userLotteryList[0] : ['user' => ['avatar' => '']],
                isset($userLotteryList[1]) ? $userLotteryList[1] : ['user' => ['avatar' => '']],
            ];*/
            if(count($userLotteryList)<3){
                $topUserLotteryList = $userLotteryList;
            }else{
                $topUserLotteryList = [$userLotteryList[0],$userLotteryList[1]];
            }
            
        }

        $order = Od::where(['rid' => $gid, 'buyer' => $uid, 'sort' => 0, 'status' => 1, 'paystatus' => 1])->find();

        $orderType = false;
        if ($order) {
            $orderComment = OdComment::where(['oid' => $order->id])->find();
            if ($orderComment->name) {
                $orderType = true;
            }
        }
        
        $returnData['orderType'] = $orderType;
        $returnData['productlottery'] = $productlottery ? $productlottery : ['isprize' => 0];
        $returnData['topUserLotterList'] = $topUserLotteryList;
        $returnData['userLotteryList'] = $userLotteryList;


        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }


    //中奖列表
    // public function prizeList(){
    //     $request = Request::instance();
    //     $appId = $request->param('appId', 'd6mBDb2J9fvT43XiKRhUu8toageH7cwS');
    //     $rid = $request->param('rid', '177');
    //     $resource = Resource::where(['id'=>$rid,'appid'=>$appId])->find();
    //     if(!$resource){
    //         return [
    //             'code' => 1,
    //             'msg' => '商品不存在'
    //         ];
    //     }
    //     $where = [
    //         'appid'=>$appId,
    //         'rid'=>$rid,
    //         'isprize'=>1
    //     ];
    //     $prizeList =  ProductLottery::with('resource,user')->where($where)->select();
    //     if($prizeList){
    //         return [
    //             'code' => 0,
    //             'msg' => '所有中奖列表',
    //             'prizeList'=>$prizeList
    //         ];
    //     }else{
    //         return [
    //             'code' => 1,
    //             'msg' => '列表为空'
    //         ];
    //     }
    // }


    //参与活动
    public function join()
    {
        $request = Request::instance();

        $appId = $request->param('appId', '');
        $userSession = $request->param('userSession', '');
        $id = $request->param('gid', '');

        $userData = Cache::get($userSession);
        $uid = $userData['userInfo']['uid'];
        $avatar = $userData['userInfo']['avatar'];

        $where = array(
            'id' => $id,
            'appid' => $appId
        );

        $returnData['goods'] = Resource::where($where)->field('id, title, price, goodssort')->find();

        if(!$returnData['goods']) {
            return [
                'code' => 1,
                'msg' => '抽奖活动不存在'
            ];
        }

        $gid = $returnData['goods']['id'];

        $where = array(
            'rid' => $gid,
            'founderuid' => $uid
        );

        $isJoin = $this->isJoin($gid, $uid);
        
        if($isJoin) {
            return [
                'code' => 1,
                'msg' => '已经参与过抽奖了'
            ];
        } else {
            $where = array(
                'rid' => $gid
            );

            $returnData['lottery'] = ResourceProductLottery::where($where)->field('joinnum, endtime')->find();

            $timeStamp = time();

            if($timeStamp > $returnData['lottery']['endtime']) {
                return [
                    'code' => 1,
                    'msg' => '活动已经结束了'
                ];
            }

          

            $msg = $returnData['lottery']['joinnum'] > 0 ? '参与成功，快去邀请好友助力' : '参与成功，等待开奖';
            $buttonType = $returnData['lottery']['joinnum'] > 0 ? 'invite' : 'wait';
            $buttonText = $returnData['lottery']['joinnum'] > 0 ? '邀请好友助力' : '等待开奖';
            $status = $returnData['lottery']['joinnum'] > 0 ? 0 : 1;

            $postData = array(
                'appid' => $appId,
                'rid' => $gid,
                'uid' => $uid,
                'status' => $status
            );
            $id = ProductLottery::create($postData);

            // $model = new ProductLottery();
            // $update = $model->save(['status'=>$status],['id'=>$id]);

           
              // $returnData['lotterys'] = ProductLottery::where($where)->find();

            // $msg = $returnData['lottery']['joinnum'] < $returnData['lotterys']['joinnum'] ? '参与成功，快去邀请好友助力' : '参与成功，等待开奖';
            // $buttonType = $returnData['lottery']['joinnum'] < $returnData['lotterys']['joinnum'] ? 'invite' : 'wait';
            // $buttonText = $returnData['lottery']['joinnum'] < $returnData['lotterys']['joinnum'] ? '邀请好友助力' : '等待开奖';
            // $status = $returnData['lottery']['joinnum'] < $returnData['lotterys']['joinnum'] ? 0 : 1;


            ResourceProductLottery::where($where)->setInc('totalnum');
        }
        
        return [
            'code' => 0,
            'msg' => $msg,
            'buttonType' => $buttonType,
            'buttonText' => $buttonText
        ];
    }

    
    public function help()
    {
        $request = Request::instance();

        $appId = $request->param('appId', '');
        $userSession = $request->param('userSession', '');
        $id = $request->param('gid', '');
        $lid = $request->param('lid', '', 'intval');//参与助力活动表id

        $userData = Cache::get($userSession);
        $uid = $userData['userInfo']['uid'];
        $avatar = $userData['userInfo']['avatar'];

        if (!$uid) {
            return ['code' => 2, 'msg' => '请重新登陆'];
        }

        $where = array(
            'id' => $lid,
            'appid' => $appId
        );

        $lotteryUser = ProductLottery::where($where)->field('uid, joinnum')->find();//参与人

        $where = array(
            'rid' => $id
        );

        $lottery = ResourceProductLottery::where($where)->field('joinnum, endtime, totalnum, status')->find();//添加商品时添加的
        
        $timeStamp = time();

        if($timeStamp > $lottery['endtime']) {
            return [
                'code' => 1,
                'msg' => '活动已经结束了'
            ];
        }


        $where = array(
            'lid' => $lid,
            'appid' => $appId,
            'uid' => $uid
        );

        $isJoin = ProductLotteryUser::where($where)->field('uid')->find();
        $buttonType = '';
        $buttonText = '';
        if($lotteryUser && $lotteryUser['joinnum'] < $lottery['joinnum'] && $uid != $lotteryUser['uid'] && !$isJoin) {
            $username = $userData['userInfo']['username'];
            $avatar = $userData['userInfo']['avatar'];

            $postData = array(
                'lid' => $lid,
                'appid' => $appId,
                'founderuid' => $lotteryUser['uid'],
                'uid' => $uid,
                'avatar' => $avatar,
                'username' => $username,
            );

            ProductLotteryUser::create($postData);

            $where = array(
                'id' => $lid,
                'appid' => $appId
            );

            ProductLottery::where($where)->setInc('joinnum');

            $where = array(
                'rid' => $id
            );

            ResourceProductLottery::where($where)->setInc('totalnum');

            $msg = '助力成功';
            $buttonType = 'helped';
            $buttonText = '已助力好友';

        } else {
            
            $msg = $lotteryUser['joinnum'] >= $lottery['joinnum'] ? '助力已满' : '助力失败';
            if ($isJoin) {
                $msg = '已助力好友';
            }
        }

        return [
            'code' => 0,
            'msg' => $msg,
            'buttonType' => $buttonType,
            'buttonText' => $buttonText
        ];
    }

    public function order() 
    {
        $request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');
        $status = $request->param('status', '');

        $page = $request->param('page', 1, 'intval');
        $pageSize = 10;

        $userData = Cache::get($userSession);
        if (!$userData) {
            return ['code' => 1, 'msg' => '用户不存在'];
        }

        $uid = $userData['userInfo']['uid'];

        $where = array(
            'appid' => $appId,
            'uid' => $uid,
            'status' => 0,
        );

        $returnData['total'] = ProductLottery::where($where)->count();
        $returnData['page'] = $page;
        $returnData['size'] = $pageSize;

        $orderlist = ProductLottery::with('resource,lottery')->where($where)->order('id desc')->select();

        foreach ($orderlist as $key => $value) {
            $returnData['list'][$key]['id'] = $value['id'];
            $returnData['list'][$key]['rid'] = $value['rid'];
            $returnData['list'][$key]['joinnum'] = $value['lottery']['totalnum'];
            $returnData['list'][$key]['status'] = $value['status'];
            $returnData['list'][$key]['isprize'] = $value['isprize'];
            $returnData['list'][$key]['title'] = $value['resource']['title'];
            $returnData['list'][$key]['cover'] = $value['resource']['cover'];
            $returnData['list'][$key]['setjoinnum'] = $value['lottery']['joinnum'];
            $returnData['list'][$key]['prizenum'] = $value['lottery']['pricenum'];
            $returnData['list'][$key]['endtime'] = date("Y年m月d日 H:m", $value['lottery']['endtime']);
        }

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }

    private function isJoin($id, $uid, $lid = '') {
        $where = array(
            'rid' => $id,
            'uid' => $uid
        );

        if($lid) {
            $where['id'] = $lid;
        }

        $isJoin = ProductLottery::where($where)->field('id, uid')->order('id desc')->find();

        return $isJoin;
    }

    public function shipment(){
        $request = Request::instance();
        $appId = $request->param('appId', '', 'htmlspecialchars');
        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $userData = Cache::get($userSession);
        $uid = $userData['userInfo']['uid'];

        if (!$userData) {
            return ['code' => 1, 'msg' => '用户不存在'];
        }
        $name = $request->param('name','','htmlspecialchars');
        $address = $request->param('address','','htmlspecialchars');
        $tel = $request->param('tel','','htmlspecialchars');

        if(!$tel && !$name && !$address){
            return ['code' => 1, 'msg' => '请收货信息'];
        }

        $rid = $request->param('rid',0);

        $goods = Resource::where(['id' => $rid])->field('title, cover')->find();

        if (!$goods) {
            return ['code' => 1, 'msg' => '奖品信息错误'];
        }

        $sn = 'FY'.date('YmdHis').substr(microtime(),2,5).rand(100000, 999999);

        $oDate = [
            'sn' => $sn,
            'title' => $goods['title'],
            'cover' => $goods['cover'],
            'status' => 1,
            'paystatus' => 1,
            'appid' => $appId,
            'buyer' => $uid,
            'totalnum' => 1,
            'sort' => 0,
            'goodsnum' => 1,
            'rid' => $rid,
        ];

       
        Db::startTrans();

        try{

            $order = Od::create($oDate);

            $cDate = [
                'oid' => $order->id,
                'name' => $name,
                'tel' =>  $tel,
                'address' =>  $address,
                'pay_time' => time(),
            ];

            $orderComment = OdComment::create($cDate);
            Db::commit();

        } catch (\Exception $e) {
                // 回滚事务
            Db::rollback();
            return ['code' => 1,'msg' => '创建订单错误'];
        }

        return ['code' => 0, 'msg' => '成功', 'data' => $orderComment];
    }
}
