<?php

namespace app\api\model;

use think\Model;

class User extends Model
{
    public function getUser($openId, $appid) {

        $where['openid'] = $openId;
        $returnData = User::where($where)->find();

        return $returnData;
    }

    public function addUser($userData, $sessionKey) {

        $userInfo = User::create($userData);

        return $userInfo;

    }
}
