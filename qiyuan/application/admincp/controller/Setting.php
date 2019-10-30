<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\AppVersion;
use app\admincp\model\AppTemplate;
use app\admincp\model\Setting as Set;
use OSS\Core\OssException;
use OSS\OssClient;
use think\Request;
use think\Cache;
use think\Db;

use library\Helper;

class Setting extends Base {

    public function index() {

    	$appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $appId = $loginInfo['appId'];

      $request = Request::instance();
      $act = $request->param('act');

      $where['appid'] = $appId;
      $appInfo = App::where($where)->field('refreshtoken, wxappid, comment, status, name, wxinfo')->find();

      $appInfo['comment'] = json_decode($appInfo['comment'], TRUE);

      $mpAccessToken = Cache::get('mpAccessToken_'.$appId);

      if(!$mpAccessToken) {
        $wxappid = $appInfo['wxappid'];
        $token = $appInfo['refreshtoken'];

        $result = Helper::getWxToken($wxappid, $token);

        if($result['errcode'] == 0) {
          $mpAccessToken = $result['authorizer_access_token'];
          Cache::set('mpAccessToken_'.$appId, $mpAccessToken, 3600);
        }
      }

      if(!$act) {
        $wxInfo = explode("\t", Helper::authcode($appInfo['wxinfo'], 'DECODE'));

        $this->assign('wxInfo', $wxInfo);
      }

      if($act == 'swiper') {

        $where = array(
          'appid' => $appId,
          'keyword' => 'swiper',
          'status' => 0
        );
        
        $settingList = Set::where($where)->column('id, value');

        $swiperList = array();

        if(count($settingList) > 0) {
          foreach ($settingList as $key => $value) {
            $swiperList[$key] = json_decode($value, TRUE);
          }
        }

        $this->assign('swiperList', $swiperList);
      }

      if($act == 'version') {
        $where['appid'] = $appId;
        $versionInfo = AppVersion::where($where)->column('status, publisher, version, description, categoryid, tag, create_time');

        $appTemplate = AppTemplate::where('status = 0')->column('id, isnew, version');

        $nowVersion = $versionInfo[2]['version'];
        $isUpdate = '';

        $mpCategory = $this->getMpCategory($appId);

        $this->assign('isUpdate', $isUpdate);
        $this->assign('appTemplate', $appTemplate);
        $this->assign('versionInfo', $versionInfo);
        $this->assign('mpCategory', $mpCategory['category_list']);
      }

      $this->assign('appInfo', $appInfo);
      $this->assign('act', $act);
      $this->assign('appId', $appId);
    	$this->assign('title','系统设置');
      return $this->fetch();
    
    }

    public function save() {
      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $appId = $loginInfo['appId'];

      $request = Request::instance();

      $wxAppId = $request->param('appId', '', 'htmlspecialchars');
      $wxAppSecret = $request->param('appSecret', '', 'htmlspecialchars');

      $wxInfo = Helper::authcode("$wxAppId\t$wxAppSecret", 'ENCODE');

      $where['appId'] = $appId;

      $updateData = array(
        'wxinfo' => $wxInfo
      );

      App::where($where)->update($updateData);

      $this->redirect('/admincp/setting');

    }

    public function uploadVersion() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];

      $where['isnew'] = 1;

      $appTemplate = AppTemplate::where($where)->find();

      $templateId = $appTemplate['templateid'];
      $version = $appTemplate['version'];
      $versionDesc = $appTemplate['description'];
      $ext = array(
        'ext' => array(
          'appid' => $appId
        )
      );

      $ext = json_encode($ext, JSON_UNESCAPED_UNICODE);

      $result = $this->postVersion($templateId, $ext, $version, $versionDesc, $appId);

      if($result['errcode'] == 0) {

        $where = array(
          'appid' => $appId,
          'status' => 0
        );

        $versionInfo = AppVersion::where($where)->find();

        $postData = array(
          'appid' => $appId,
          'publisher' => $username,
          'version' => $appTemplate['id'],
          'status' => 0,
          'description' => $appTemplate['description']
        );

        if($versionInfo) {
          $where = array(
            'id' => $versionInfo['id'],
            'appid' => $appId,
            'status' => 1
          );

          AppVersion::where($where)->update($postData);
        } else {
          AppVersion::create($postData);
        }

      }

      return $result;

    }

    public function submitAudit() {
      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];

      $request = Request::instance();

      $cateid = $request->param('category');
      $tag = $request->param('tag', '', 'htmlspecialchars');

      $mpCategory = $this->getMpCategory($appId);
      $mpAccessToken = Cache::get('mpAccessToken_'.$appId);

      $url = 'https://api.weixin.qq.com/wxa/submit_audit?access_token='.$mpAccessToken;

      $data = [
        'item_list' => [[
          'address' => 'pages/index/index',
          'tag' => $tag,
          'first_class' => $mpCategory['category_list'][$cateid]['first_class'],
          'second_class' => $mpCategory['category_list'][$cateid]['second_class'],
          'first_id'=> $mpCategory['category_list'][$cateid]['first_id'],
          'second_id'=> $mpCategory['category_list'][$cateid]['second_id'],
          'title' => '首页'
        ]]
      ];

      $result = Helper::curlPost($url, json_encode($data, JSON_UNESCAPED_UNICODE));
      $result = json_decode($result, TRUE);

      if($result['errcode'] == 0) {
        $appTemplate = AppTemplate::where('isnew = 1')->find();

        $templateId = $appTemplate['templateid'];
        $version = $appTemplate['version'];
        $versionDesc = $appTemplate['description'];

        $where = array(
          'appid' => $appId,
          'status' => 1
        );

        $versionInfo = AppVersion::where($where)->find();

        $postData = array(
          'appid' => $appId,
          'publisher' => $username,
          'version' => $appTemplate['id'],
          'tag' => $tag,
          'categoryid' => $cateid,
          'status' => 1,
          'description' => $appTemplate['description'],
          'auditid' => $result['auditid'] ? $result['auditid'] : '',
        );

        if($versionInfo) {
          $where = array(
            'id' => $versionInfo['id'],
            'appid' => $appId,
            'status' => 1
          );

          AppVersion::where($where)->update($postData);
        } else {
          AppVersion::create($postData);
        }
      }

      return $result;
    }

    public function postVersion($templateId, $ext, $version, $versionDesc, $appId) {
      $mpAccessToken = Cache::get('mpAccessToken_'.$appId);

      $url = 'https://api.weixin.qq.com/wxa/commit?access_token='.$mpAccessToken;
      $data = [
          'template_id' => $templateId,
          'ext_json' => $ext,
          'user_version' => $version,
          'user_desc' => $versionDesc
      ];

      $result = Helper::curlPost($url, json_encode($data));
      $result = json_decode($result, TRUE);

      return $result;
    }

    public function getMpCategory($appId) {
      $mpAccessToken = Cache::get('mpAccessToken_'.$appId);

      $url = 'https://api.weixin.qq.com/wxa/get_category?access_token='.$mpAccessToken;

      $result = Helper::curlPost($url, '', 'GET');
      $result = json_decode($result, TRUE);

      return $result;
    }

    public function checkAuditStatus() {
      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $appId = $loginInfo['appId'];

      $mpAccessToken = Cache::get('mpAccessToken_'.$appId);

      $url = 'https://api.weixin.qq.com/wxa/get_latest_auditstatus?access_token='.$mpAccessToken;

      $result = Helper::curlPost($url, '', 'GET');
      $result = json_decode($result, TRUE);

      return $result;
    }

    public function getQrCode() {

        $appInfo = new App();
        $loginInfo = $appInfo->getLoginInfo();

        $openId = $loginInfo['openId'];
        $appId = $loginInfo['appId'];

        $endpoint = config('oss.endpoint_internet');
        $bucket = config('oss.bucket');
        $accessId = config('oss.access_id');
        $accessSecret = config('oss.access_secret');
        $ossHost = config('oss.cdn_host');

        $mpAccessToken = Cache::get('mpAccessToken_'.$appId);

        $url = 'https://api.weixin.qq.com/wxa/get_qrcode?access_token='.$mpAccessToken;

        $result = Helper::curlPost($url, '', 'GET');

        $date = Date('Y').'/'.Date('m');
        $folder = "mp/qrcode/$appId/";
        $fileName = $appId.'.png';
        $object = $folder.$fileName;

        try {
          $ossClient = new OssClient($accessId, $accessSecret, $endpoint);
          $result = $ossClient->putObject($bucket, $object, $result);

          return [
            'error' => '',
            'url' => $ossHost.'/'.$object
          ];
        } catch (OssException $e) {
          return [
            'error' => '下载失败'
          ];
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

            $returnData = Set::create($postData);

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
      
      $swiperDetail = Set::where($where)->find();

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

            $returnData = Set::where($where)->update($updateData);

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

            $returnData = Set::where($where)->update($updateData);

        } else {
            return json_encode(array('error' => 'appid不存在'));
        }
    }

}
