<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\Setting;
use think\Request;
use think\Db;
use app\admincp\model\Order;
use app\admincp\model\ProductLotteryUser;
class Group extends Base {

    public function index() {

    	$appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $appId = $loginInfo['appId'];

      $request = Request::instance();
      $act = $request->param('act');
      $status = $request->param('status',-1);
      $sn = $request->param('keyword','');
      //echo $sn;die;
      $where = array(
          'sort'=>1,

      );
      if($sn){
        $where['sn'] = $sn;
      }

     // var_dump($where);die;
      if($status ==-1){
          $userOrderList = Order::where(['sort'=>1])->order(['id'=>'desc'])->paginate(20);
      }else{
          $where['status'] = $status;
          $userOrderList = Order::where($where)->order(['id'=>'desc'])->paginate(20);
      }
      foreach($userOrderList as $k=>$v){
          $userOrderList[$k]['names'] = Db::name('order_comment')->where(['oid'=>$v['id']])->value('name');
          $userOrderList[$k]['create_time'] = Db::name('order_comment')->where(['oid'=>$v['id']])->value('create_time');
          if($v['status'] == 0){
              $userOrderList[$k]['status'] = '待付款';
          }elseif($v['status'] == 1){
              $userOrderList[$k]['status'] = '待发货';
          }elseif($v['status'] == 2){
              $userOrderList[$k]['status'] = '已发货';
          }elseif($v['status'] == 3){
              $userOrderList[$k]['status'] = '已完成';
          }elseif($v['status'] == 4){
              $userOrderList[$k]['status'] = '提交退款';
          }elseif($v['status'] == 5){
              $userOrderList[$k]['status'] = '退款成功';
          }elseif($v['status'] == 6){
              $userOrderList[$k]['status'] = '退款失败';
          }elseif($v['status'] == 7){
              $userOrderList[$k]['status'] = '已关闭';
          }elseif($v['status'] == 8){
              $userOrderList[$k]['status'] = '待成团';
          }
      }
       // var_dump(collection($userOrderList)->toArray());
      /*$where = array(
        'appid' => $appId,
        'keyword' => 'swiper',
        'status' => 0
      );*/
      
     // $settingList = Setting::where($where)->column('id, value');

     // $settingSwiperList = array('swiperisAuto', 'swiperisShowDot', 'swiperinterval');

      //$where['keyword'] = ['in', $settingSwiperList];
      //$where['appId'] = $appId;

     // $settingSwiper = Setting::where('keyword', 'in', $settingSwiperList)->column('keyword, value');

      /*$swiperList = array();

      if(count($settingList) > 0) {
        foreach ($settingList as $key => $value) {
          $swiperList[$key] = json_decode($value, TRUE);
        }
      }*/
        $page = $userOrderList->render();
        $this->assign('page',$page);
        $this->assign('userOrderList',$userOrderList);
        $this->assign('status',$status);
        $this->assign('act', $act);
    	$this->assign('title','功能设置');
      return $this->fetch();
    
    }


    //关闭
    public function close(){
        $request = Request::instance();
        $id = $request->param('id','');
        $status = $request->param('status','');
        $update = Order::get($id);
        $update->status = 7;
        $save = $update->save();
        if($save){
                $this->redirect('Group/index',['status'=>$status]);

        }
    }

    //设置团购全局设置
    public function save(){
        $request = Request::instance();
        $joinnum = $request->param('joinnum','','intval');
        echo "111";die;

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
