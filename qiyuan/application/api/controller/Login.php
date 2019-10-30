<?php
namespace app\api\controller;

use app\api\model\App;
use app\api\model\User;
use think\Config;
use think\Request;
use think\Cache;
use think\Log;

use Wechat\login\WXBizDataCrypt;
use library\Helper;

class Login {

    private function createRandomStr($openid, $wxappid){
        $str = $openid.$wxappid.'fypappusersalt';
        $skey = hash("sha256", $str);
        return $skey;
    }

    public function index() {

        $request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');

        $code = $request->param('code');
        $iv = $request->param('iv');
        $encryptedData = $request->param('encryptedData');

        if (isset($sessionInfo['errcode'])) {
            return ['code' => 1, 'msg' => '缺少参数'];
        }

        $where = array(
            'appid' => $appId
        );

        $appInfo = App::where($where)->column('wxinfo');

        if(!$appInfo) {
            return ['code' => 1, 'msg' => '应用不存在'];
        }

        $wxInfo =  explode("\t", Helper::authcode($appInfo[0], 'DECODE'));

        $wxAppId = Config::get('wxAppId');
        $wxAppSecret = Config::get('wxAppSecret');

        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        $data = [
            'appid' => $wxAppId,
            'secret' => $wxAppSecret,
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        ];

        $result = PostData($data, $url);
        $sessionInfo = json_decode($result, TRUE);

        if (isset($sessionInfo['errcode'])) {
            return ['code' => 1, 'msg' => $sessionInfo['errmsg']];
        }

        $openId = $sessionInfo['openid'];
        $sessionKey = $sessionInfo['session_key'];

        $dataCrypt = new WXBizDataCrypt($wxAppId, $sessionKey);
        $errCode = $dataCrypt->decryptData($encryptedData, $iv, $data);

        if ($errCode !== 0) {
            return ['code' => 1, 'msg' => '错误'.$errCode];
        }

        $userInfo = json_decode($data, TRUE);
Log::record(json_encode(['user==========>' => $userInfo]));
        $userSession = $this->createRandomStr($openId, $wxAppId);
        
        $userName = isset($userInfo['nickName']) ? $userInfo['nickName'] : '';
        $openId = $userInfo['openId'];
        $userAvatar = isset($userInfo['avatarUrl']) ? $userInfo['avatarUrl'] : '';
        $gender = isset($userInfo['gender']) ? $userInfo['gender'] : 0;
        $city = isset($userInfo['city']) ? $userInfo['city'] : '';
        $province = isset($userInfo['province']) ? $userInfo['province'] : '';

        $unionId = isset($userInfo['unionId']) ? $userInfo['unionId'] : '';

        $userQuery = new User();
        $returnData = array();

        $phone = '';
        if($openId) {

            $userExist = $userQuery->getUser($openId, $appId);
            if(empty($userExist['id'])) {

                $userData = array(
                    'openid' => $openId,
                    'unionid' => $unionId,
                    'appid' => $appId,
                    'username' => $userName,
                    'nickname' => $userName,
                    'avatar' => $userAvatar,
                    'gender' => $gender,
                    'city' => $city,
                    'province' => $province,
                );

                $returnUserInfo = $userQuery->addUser($userData, $userSession);

                $uid = $returnUserInfo['id'];

            } else {
                
                $userName = $userName;
                $userAvatar = $userAvatar;
                $uid = $userExist['id'];
                $admingroup = $userExist['admingroup'];
                $phone = $userExist['phone'];

                $user = User::where(['openid' => $openId])->find();
                $user->username = $userName;
                $user->nickname = $userName;
                $user->avatar = $userAvatar;
                $user->unionid = $unionId;
                $user->save();
                // $userName = $userExist['username'];
                // $userAvatar = $userExist['avatar'];
                // $uid = $userExist['id'];
                // $admingroup = $userExist['admingroup'];
                // $phone = $userExist['phone'];
            }

            $userData = array(
                'userInfo' => array(
                    'username' => $userName,
                    'avatar' => $userAvatar,
                    'uid' => $uid,
                    'phone' => $phone,
                ),

                'userSession' => $userSession,
                'openId' => $openId
            );

            Cache::set($userSession, $userData);

            $returnData = $userData;
        }

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];

    }

    public function getPhone()
    {
//        echo strlen('9H2x+4hEXKPvCx+6bpcWVw==');exit;
        $request = Request::instance();
        $appId = $request->param('appId', '');
        $userSession = $request->param('userSession', '');
        $code = $request->param('code', '');
        $encryptedData = $request->param('encryptedData', '');
        $iv = $request->param('iv', '');

        if (!$appId || !$code || !$encryptedData || !$iv) {
            return ['code' => 1, 'msg' => '参数错误'];
        }
        $userData = Cache::get($userSession);
        if (!$userData) {
            return ['code' => 1, 'msg' => '用户不存在'];
        }

        $uid = $userData['userInfo']['uid'];

        $where = array(
            'appid' => $appId
        );

        $appInfo = App::where($where)->column('wxinfo');

        if(!$appInfo) {
            return ['code' => 1, 'msg' => '应用不存在'];
        }

        $wxInfo =  explode("\t", Helper::authcode($appInfo[0], 'DECODE'));

        // $wxAppId = $wxInfo[0];
        // $wxAppSecret = $wxInfo[1];
        $wxAppId = Config::get('wxAppId');
        $wxAppSecret = Config::get('wxAppSecret');

        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        $data = [
            'appid' => $wxAppId,
            'secret' => $wxAppSecret,
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        ];
        $result = Helper::curlPost($url, $data);
        $sessionInfo = json_decode($result, TRUE);
        $openId = $sessionInfo['openid'];
        $sessionKey = $sessionInfo['session_key'];

        if ($openId && $sessionKey) {
            $pc = new WXBizDataCrypt($wxAppId, $sessionKey);
            $errCode = $pc->decryptData($encryptedData, $iv, $data);
            if ($errCode !== 0) {
                return ['code' => $errCode, 'msg' => '解析错误'];
            }
            $info = json_decode($data, TRUE);

            $phone = $info['phoneNumber'];

            $user = User::where(['appid' => $appId, 'openid' => $openId ,'id' => $uid])->find();

            $user->phone = $phone;
            $user->save();

        } else {
            return ['code' => 1, 'msg' => '登录错误'];
        }

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $info
        ];
    }
    

}
