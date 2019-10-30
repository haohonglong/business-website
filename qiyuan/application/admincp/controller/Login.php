<?php

namespace app\admincp\controller;

use app\admincp\model\App;
use app\admincp\model\Adminuser;
use think\Cache;
use library\Helper;
use think\Request;
use think\Cookie;

class Login extends Base {

    public function index1() {

        $request = Request::instance();
        if($request->param()) {
            $username = Request::instance()->param('username', '');
            $password = Request::instance()->param('password', '');

            $where = array(
                'username' => $username,
                'password' => md5($password)
            );

            $adminInfo = Adminuser::where($where)->column('id');

            if($adminInfo) {

                $adminUserCookies = "$adminInfo[0]\t$username";
                Cookie::set('feeyanAdmin', authcode($adminUserCookies, 'ENCODE'));
                $this->redirect('/admincp/index');

            } else {
                $this->redirect('/admincp/Login');
            }
        } else {
            $this->assign('title', '登录');
            return $this->fetch();
        }

    }


    public function index() {
        $request = Request::instance();
        if($request->param()) {
            $username = Request::instance()->param('username', '');
            $password = Request::instance()->param('password', '');

            $where = array(
                'username' => $username,
                'password' => md5($password)
            );

            $adminInfo = Adminuser::where($where)->column('id');

            if($adminInfo) {
                $adminUserCookies = "$adminInfo[0]\t$username";
                Cookie::set('feeyanAdmin', authcode($adminUserCookies, 'ENCODE'));
                $this->redirect('/admincp/index');

            } else {
//                echo 'eee';die;
                $this->redirect('/admincp/Login');
            }
        } else {
            $this->assign('title', '登录');
            return $this->fetch();
        }

    }

}


// namespace app\admincp\controller;

// use app\admincp\model\Loginlog;
// use app\admincp\model\App;
// use app\wx\model\Wxuser;
// use think\Cache;
// use think\Request;
// use think\Cookie;
// use library\Helper;

// class Login extends Base {

//     public function index() {

//         $request = Request::instance();
//         $appid = $request->param('appid', '', 'htmlspecialchars');

//         $codeUrl = '';

//         if(!$appid) {

//             $accesstoken = Cache::get('wxMpAccessToken');

//             if(!$accesstoken) {

//                 $wxAppId = 'wxa6c8cd6f0172fdfd';
//                 $wxAppSecret = '1f7d2aa7b059e1a490edabb84f0c2367';

//                 $url = 'https://api.weixin.qq.com/cgi-bin/token';
//                 $params = [
//                     'appid' => $wxAppId,
//                     'secret' => $wxAppSecret,
//                     'grant_type' => 'client_credential'
//                 ];

//                 $result = Helper::curlPost($url, $params);
//                 $result = json_decode($result, TRUE);

//                 Cache::set('wxMpAccessToken', $result['access_token'], 7000);

//                 $accesstoken = $result['access_token'];

//             }

//             $codeUrl = $this->createLoginCode($accesstoken);

//         }

//         // // $where = array(
//         // //     'appid' => $appid
//         // // );

//         // // $appInfo = App::where($where)->field('wxinfo, status')->find()->toArray();

//         // if($appInfo) {
//         //     list($wxId, $wxSecret) = explode("\t", authcode($appInfo['wxinfo'], 'DECODE'));

//         //     $charid = md5(uniqid(mt_rand(), true).time());
//         //     $qrcode = 'loginQrcode_'.substr($charid, 20, 12);

//         //     Cache::set($qrcode, $wxId, 600);
//         // }

//         //$qrcodeShow = 'admin:login:'.$qrcode;

//         $charid = md5(uniqid(mt_rand(), true).time());
//         $qrcode = 'loginQrcode_'.substr($charid, 20, 12);

//         $this->assign('appid', $appid);
//         $this->assign('qrcode', $qrcode);
//         $this->assign('codeUrl', $codeUrl);
//         $this->assign('title', '登录');
        
//         return $this->fetch();
//     }

//     public function submit() {
//         $request = Request::instance();
//         $loginCode = $request->param('loginCode', '', 'htmlspecialchars');

//         $where = array(
//             'code' => $loginCode,
//             'status' => 0
//         );

//         $log = Loginlog::where($where)->find();

//         if($log['expiry'] && time() < $log['expiry']) {

//             $where = array(
//                 'openid' => $log['openid'],
//             );

//             $userInfo = Wxuser::where($where)->find();

//             $username = $userInfo['username'];
//             $uid = $userInfo['id'];
//             $openid = $userInfo['openid'];

//             $cookiesValue = Helper::authcode("$username\t$uid\t$openid\t\tWX", 'ENCODE');

//             $where = array(
//                 'code' => $loginCode,
//                 'openid' => $log['openid']
//             );

//             $updateData['status'] = 1;

//             Loginlog::where($where)->update($updateData);

//             Cookie::set('feeyanAdmin', $cookiesValue);

//             $this->redirect('/admincp');
//         } else {
//             echo '登录密码错误或已失效';
//         }
//     }

//     public function createLoginCode($accesstoken) {
//         $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$accesstoken;
//         $params = [
//             'expire_seconds' => '3600',
//             'action_name' => 'QR_STR_SCENE',
//             'action_info' => array(
//                 'scene' => array(
//                     'scene_str' => 'login'
//                 )
//             )
//         ];

//         $params = json_encode($params);

//         $result = Helper::curlPost($url, $params);
//         $result = json_decode($result, TRUE);

//         return $result['ticket'];

//     }

//     public function createQrcode() 
//     {   

//         $appid = isset($_GET['appid']) ? htmlspecialchars($_GET['appid']) : '';
//         $qrcode = isset($_GET['qrcode']) ? htmlspecialchars($_GET['qrcode']) : '';

//         $where = array(
//             'appid' => $appid
//         );

//         $appInfo = App::where($where)->field('wxinfo, status')->find()->toArray();

//         if($appInfo) {
//             list($wxId, $wxSecret) = explode("\t", authcode($appInfo['wxinfo'], 'DECODE'));

//             $accessToken = Cache::get($wxId);

//             if(!$accessToken) {
//                 $accessToken = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$wxId.'&secret='.$wxSecret);
//                 $returnData = json_decode($accessToken, TRUE);

//                 $accessToken = $returnData['access_token'];

//                 Cache::set($wxId, $accessToken, 3600);
//             }

//             $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$accessToken;

//             Cache::set($qrcode, $wxId, 600);

//             $params = [
//                 'page' => "pages/admin/index",
//                 'scene' => $qrcode,
//                 'is_hyaline' => true
//             ];

//             $params = json_encode($params);

//             $result = Helper::curlPost($url, $params);

//             echo $result;
//         }
//     }



// }
