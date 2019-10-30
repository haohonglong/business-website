<?php

namespace app\api\controller;

use library\Helper;
use library\Weixin;
use think\Cache;
use think\Controller;
use think\Request;

class Share
{
    public function getwxacode(Request $request)
    {
        $request = Request::instance();
        $appId = $request->param('appId', '');
        $scene = $request->param('scene', '123');
        $page = $request->param('page', '');

        // if (!$appId || !$scene || !$page) {
        //     return ['code' => 1, 'msg' => '参数错误'];
        // }

        $tokenInfo = Weixin::getAccessToken();
        if (isset($tokenInfo['errcode'])) {
            return ['code' => 1, 'msg' => $tokenInfo['msg']];
        }
        $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$tokenInfo['access_token'];
        $params = [
            'scene' => $scene,
            'page' => $page,
            'width' => 430,
            'is_hyaline' => true,
        ];
        $params = json_encode($params, JSON_UNESCAPED_UNICODE);
        $result = PostData( $params, $url);
        if (strpos($result, 'errcode')) {
            return ['code' => 1, 'msg' => '获取二维码失败'];
        }

        echo $result;
    }

    public function updateCount()
    {
        $request = Request::instance();
        $appId = $request->param('appId', '');
        $resourceId = $request->param('resourceId', '');
        $type = $request->param('type', 1);  // 1-视频  2-问答 3-图文
        $userSession = $request->param('userSession', '');

        if (!$appId || !$resourceId || !$type) {
            return ['code' => 1, 'msg' => '参数错误'];
        }
        $userData = UserSession::getInfo($userSession);
        if (!$userData) {
            return [ 'code' => 1,'msg' => '用户不存在'];
        }
        $uid = $userData['userInfo']['uid'];
        $username = $userData['userInfo']['username'];
        $avatar = $userData['userInfo']['avatar'];

        switch ($type) {
            //视频
            case 1:
                \app\api\model\Article::where([
                    'appid' => $appId,
                    'id' => $resourceId
                ])->setInc('share_count');
                $shareId = UserShare::where(['uid'=>$uid,'article_id'=>$resourceId,'type'=>1])->value('id');
                if (!$shareId) {
                    UserShare::create([
                        'appid' => $appId,
                        'uid' => $uid,
                        'username' => $username,
                        'avatar' => $avatar,
                        'article_id' => $resourceId,
                        'type' => 1
                    ]);
                } else {
                    UserShare::where(['uid'=>$uid,'article_id'=>$resourceId,'type'=>1])->update([
                        'update_time' => date('Y-m-d H:i:s')
                    ]);
                }
                $redisKey = 'shareUsersCount:article:'.$appId.':'.$resourceId;
                Cache::rm($redisKey);
                $redisKey = 'shareUsersList:article:'.$appId.':'.$resourceId;
                Cache::rm($redisKey);
                break;
            //问答
            case 2;
                \app\api\model\Question::where([
                    'appid' => $appId,
                    'id' => $resourceId
                ])->setInc('share_count');
                break;
            //图文
            case 3:
                \app\api\model\Article::where([
                    'appid' => $appId,
                    'id' => $resourceId
                ])->setInc('share_count');

                $shareId = UserShare::where(['uid'=>$uid,'article_id'=>$resourceId,'type'=>2])->value('id');
                if (!$shareId) {
                    UserShare::create([
                        'appid' => $appId,
                        'uid' => $uid,
                        'username' => $username,
                        'avatar' => $avatar,
                        'article_id' => $resourceId,
                        'type' => 2
                    ]);
                } else {
                    UserShare::where(['uid'=>$uid,'article_id'=>$resourceId,'type'=>2])->update([
                        'update_time' => date('Y-m-d H:i:s')
                    ]);
                }
                $redisKey = 'shareUsersCount:article:'.$appId.':'.$resourceId;
                Cache::rm($redisKey);
                $redisKey = 'shareUsersList:article:'.$appId.':'.$resourceId;
                Cache::rm($redisKey);
                break;
        }

        return ['code' => 0, 'msg' => '成功'];
    }
}
