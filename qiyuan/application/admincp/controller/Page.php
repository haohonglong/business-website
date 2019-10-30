<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\Setting;
use think\Request;
use think\Db;

class Page extends Base {

    public function index() {

    	$appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];
      $uid = $loginInfo['uid'];

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

      $this->assign('settingSwiper', $settingSwiper);
      $this->assign('swiperList', $swiperList);
    	$this->assign('title','功能设置');
      return $this->fetch();
    
    }

    public function setting() {
      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];
      $uid = $loginInfo['uid'];

      $request = Request::instance();
      $act = $request->param('act', '', 'htmlspecialchars');

      print_r($request->param());

      $Setting = new Setting;

      if($act == 'swiper') {

        $settingSwiperList = array('isAuto', 'isShowDot', 'interval');

        $param = $request->param();

        foreach ($settingSwiperList as  $item) {
          $keyword = 'swiper'.$item;

          if(isset($param['swiper'][$item])) {
            $swiperUpdateData[$keyword] = $param['swiper'][$item];
          } else {
            $swiperUpdateData[$keyword] = '';
          }
        }

        foreach ($swiperUpdateData as $key => $value) {
            $where['keyword'] = $key;
            $where['appId'] = $appId;

            $isExist = Setting::where($where)->find();

            if($isExist) {
              $updateData['value'] = $value;
              Setting::where($where)->update($updateData);
            } else {
              $createData = array(
                'appid' => $appId,
                'keyword' => $key,
                'value' => $value
              );

              Setting::create($createData);
            }
          }
      }
    }

    public function addSwiper() {

        $request = Request::instance();

        $cover = $request->param('cover', '', 'htmlspecialchars');
        $link = $request->param('link', '', 'htmlspecialchars');

        $appInfo = new App();
        $loginInfo = $appInfo->getLoginInfo();

        $openId = $loginInfo['openId'];
        $appId = $loginInfo['appId'];
        $username = $loginInfo['username'];
        $uid = $loginInfo['uid'];

        if($appId) {

            $value = array(
                'cover' => $cover,
                'link' => $link
            );

            $postData = array(
                'appid' => $appId,
                'keyword' => 'swiper',
                'value' => json_encode($value)
            );

            $returnData = Setting::create($postData);

            return json_encode(array('id' => $returnData['id']));

        } else {
            return json_encode(array('error' => 'appid不存在'));
        }
    }

    public function swiperDetail() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];
      $uid = $loginInfo['uid'];

      $id = Request::instance()->param('id', '', 'intval');

      $where = array(
        'appid' => $appId,
        'id' => $id,
        'keyword' => 'swiper'
      );
      
      $swiperDetail = Setting::where($where)->find();

      if($swiperDetail) {
        $data = $swiperDetail['value'];
      } 

      return $data;
    }

    public function editSwiper() {

        $request = Request::instance();

        $cover = $request->param('cover', '', 'htmlspecialchars');
        $link = $request->param('link', '', 'htmlspecialchars');
        $id = $request->param('id', '', 'intval');

        $appInfo = new App();
        $loginInfo = $appInfo->getLoginInfo();

        $openId = $loginInfo['openId'];
        $appId = $loginInfo['appId'];
        $username = $loginInfo['username'];
        $uid = $loginInfo['uid'];

        if($appId) {

            $where = array(
                'id' => $id,
                'appid' => $appId
            );

            $value = array(
                'cover' => $cover,
                'link' => $link
            );

            $updateData = array(
                'value' => json_encode($value)
            );

            $returnData = Setting::where($where)->update($updateData);

        } else {
            return json_encode(array('error' => 'appid不存在'));
        }
    }

    public function hiddenSwiper() {

        $request = Request::instance();

        $id = $request->param('id', '', 'intval');

        $appInfo = new App();
        $loginInfo = $appInfo->getLoginInfo();

        $openId = $loginInfo['openId'];
        $appId = $loginInfo['appId'];
        $username = $loginInfo['username'];
        $uid = $loginInfo['uid'];

        if($appId) {

            $where = array(
                'id' => $id,
                'appid' => $appId
            );

            $updateData = array(
                'status' => 1
            );

            $returnData = Setting::where($where)->update($updateData);

        } else {
            return json_encode(array('error' => 'appid不存在'));
        }
    }

}
