<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\Setting;
use app\admincp\model\Resource;
use think\Request;
use think\Db;
use app\admincp\model\ResourceProductLottery;
use app\admincp\model\Order;
use think\Config;
use app\admincp\model\ProductLottery;
use think\Session;
class Lottery extends Base {

    public function index() {
    	$appInfo = new App();
        $loginInfo = $appInfo->getLoginInfo();

        $appId = $loginInfo['appId'];

        $request = Request::instance();
        $status = $request->param('status', '-1');
        //$rid = $request->param('rid', 0);
        $rid = $request->param('id',0);
        $pages = $request->param('page',0);

        $find = ResourceProductLottery::where(['status'=>$status])->column('rid');
       
            $where = array(
                'appid' => $appId,
                'sort' => 4,
                'goodssort' => 2,
                'status' => 0,
            );
            $plist = Resource::where($where)->order(['id'=>'desc'])->field('id, title')->select();
            
        if($status != -1){
            $wheres = array(
                'appid' => $appId,
                'sort' => 4,
                'goodssort' => 2,
                'status' => 0,
            );
            
            $wheres['id'] = ['in',$find];
            $plist = Resource::where($wheres)->order(['id'=>'desc'])->field('id, title')->select();
        }

        

        if ($rid == 0 ) {
            if($pages != 0 && Session::get('rid')!=''){
                $rid = Session::get('rid');
                $listWhere = [
                    'rid'=>$rid,
                    'appid' => $appId,
                    'status' => ['in', [0, 1]]
                ];
            }else{
                Session::set('rid','');
                $listWhere = [
                    'appid' => $appId,
                    'status' => ['in', [0, 1]]
                ];
            }
        } else {
            
            Session::set('rid',$rid);
            $listWhere['rid'] = $rid;
            
            $listWhere['appid'] = $appId;
            //$listWhere['status'] = $status;
        }
        
        
        $list = ProductLottery::with('resource,user')->where($listWhere)->paginate(20);
    

        foreach($list as $k=>$v){
            if($v['status'] == 0){
                $v['status'] = "待开奖";
            }elseif($v['status'] == 1){
                $v['status'] = "已开奖";
            }elseif($v['status'] == 2){
                $v['status'] = '已关闭';
            }

            if($v['isprize'] == 0) {
                $v['isprize'] = '未中奖';
            } elseif ($v['isprize'] == 1) {
                $v['isprize'] = '已中奖';
            }
            $list[$k] = $v;
            //echo $plist[$k]['appid'] ;die;
        }

        $page = $list->render();
        $this->assign('page',$page);
        $this->assign('rid',$rid);
        $this->assign('plist', $plist);
        $this->assign('list', $list);
        $this->assign('title','抽奖管理');
        
        return $this->fetch();
    
    }

    public function order() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $appId = $loginInfo['appId'];

      $request = Request::instance();
      $sn = $request->param('keyword','');
      $status = $request->param('status','');
      $where = array(
        'appid' => $appId,
        //'keyword' => 'swiper',
       // 'status' => 0
          'sort' => 0
      );
        if($status == 1){
            $where['status'] = 1;
        }elseif($status == 2){
            $where['status'] = 2;
        }
        if($sn!= ''){
            $where['sn'] = $sn;
        }
        $orderList = Order::where($where)->order(['id'=>'desc'])->paginate(20);
        $array = array(
            '0'=>'待付款',
            '1'=>'待发货',
            '2'=>'已发货',
            '3'=>'已完成',
            '4'=>'提交退款',
            '5'=>'退款成功',
            '6'=>'退款失败',
            '7'=>'已关闭',
            '8'=>'待成团'
        );
        foreach($orderList as $k=>$v){
            $orderList[$k]['names'] = Db::name('order_comment')->where(['oid'=>$v['id']])->value('name');
            $orderList[$k]['create_time'] = Db::name('order_comment')->where(['oid'=>$v['id']])->value('create_time');
            $orderList[$k]['status'] = $array[$v['status']];
        }

      //$settingList = Setting::where($where)->column('id, value');

      //$settingSwiperList = array('swiperisAuto', 'swiperisShowDot', 'swiperinterval');

      //$where['keyword'] = ['in', $settingSwiperList];
      //$where['appId'] = $appId;

      //$settingSwiper = Setting::where('keyword', 'in', $settingSwiperList)->column('keyword, value');

      //$swiperList = array();

      /*if(count($settingList) > 0) {
        foreach ($settingList as $key => $value) {
          $swiperList[$key] = json_decode($value, TRUE);
        }
      }*/
        $page = $orderList->render();
        $this->assign('page',$page);
        $this->assign('pages',$pages);
        $this->assign('act', 'order');
        $this->assign('orderList',$orderList);
        $this->assign('title','功能设置');
        return $this->fetch('index');
    
    }
    //关闭抽奖活动
    public function closeLottery(){
        $appInfo = new App();
        $loginInfo = $appInfo->getLoginInfo();
        $appId = $loginInfo['appId'];
        $request = Request::instance();
        $id = $request->param('id','');
        $rid = $request->param('rid');
        $model = new ProductLottery();
        $update = $model->save(['status'=>2],['id'=>$id,'appid'=>$appId]);
        if($update){
            $this->redirect("Lottery/index",['id'=>$rid]);
        }
    }
//关闭订单
    public function close(){
        $request = Request::instance();
        $id = $request->param('id','');
        $update = Order::get($id);
        $update->status = 7;
        $save = $update->save();
        if($save){
            $this->redirect('Lottery/order');
        }
    }
    
//开奖
    public function openProduct(){
        set_time_limit(0);
        $appInfo = new App();
        $loginInfo = $appInfo->getLoginInfo();
        $appId = $loginInfo['appId'];
        $request = Request::instance();
        $rid = $request->param('id', '');
        $ResourceLottery = ResourceProductLottery::where(['rid'=>$rid])->find();

        if ($ResourceLottery['status'] == 1) {
            return ['code' => 1, 'msg' => '已开奖'];
            exit();
        }

        $model = new ResourceProductLottery();
        $save = $model->save(['status'=>1],['rid'=>$rid]);


        $where = [
            'appid'=>$appId,
            'rid'=>$rid,
            'joinnum'=>['>=',$ResourceLottery['joinnum']]
        ];

        $list = ProductLottery::where($where)->select();

        //ProductLottery::where(['appid' => $appId, 'rid' => $rid, 'joinnum' => ['<', $ResourceLottery['joinnum']]])->update(['status' => 1]);
        ProductLottery::where(['appid' => $appId, 'rid' => $rid])->update(['status' => 1]);

        //$sendList = ProductLottery::with('resource')->where(['appid' => $appId, 'rid' => $rid, 'joinnum' => ['<', $ResourceLottery['joinnum']]])->select();
        $sendList = ProductLottery::with('resource')->where(['appid' => $appId, 'rid' => $rid])->select();

        

        $count = count($list);//满足开奖条件人数
        //echo $ResourceLottery['pricenum'];die;
        //$uidarray = [];
        $respricenum = $ResourceLottery['pricenum'];

        if($count <= $respricenum) {//所有满足条件的人都中奖

            foreach($list as $k=>$v){

                ProductLottery::where(['uid'=>$v['uid'], 'rid' => $v['rid']])->update(['status' => 1, 'isprize' => 1]);

            }

        } elseif ($count > $respricenum){//满足条件的人大于奖品数量

            if($respricenum ==1){

                $value = array_rand($list, $ResourceLottery['pricenum']);
                $prizeList[] = $list[$value];
            }else{

                $value = array_rand($list, $ResourceLottery['pricenum']);//随机中奖

                foreach($value as $k=>$v){
                    $prizeList[] = $list[$v];
                }
                
            }

            foreach($prizeList as $k=>$v){
                //推送微信消息
                $send = ProductLottery::where(['uid' => $v['uid'], 'rid' => $v['rid']])->update(['isprize'=>1]);


            }
        }

        foreach ($sendList as $k=>$v) {
            $model = new Wxmsg();
            $result = $model->send($v['rid'],$v['uid'],$v['resource']['title']);
        }
        return ['code' => 0, 'msg' => '开奖成功'];

        
    }


    public function setting() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $where = array(
        'appid' => $appId,
        'keyword' => 'swiper',
        'status' => 0
      );
      
      $settingList = Setting::where($where)->column('id, value');

      $settingSwiperList = array('swiperisAuto', 'swiperisShowDot', 'swiperinterval');

      $where['keyword'] = ['in', $settingSwiperList];
      $where['appId'] = $appId;

      $settingSwiper = Setting::where('keyword', 'in', $settingSwiperList)->column('keyword, value');

      $swiperList = array();

      if(count($settingList) > 0) {
        foreach ($settingList as $key => $value) {
          $swiperList[$key] = json_decode($value, TRUE);
        }
      }

      $this->assign('act', 'setting');
      $this->assign('title','功能设置');
      return $this->fetch('index');
    
    }

}
