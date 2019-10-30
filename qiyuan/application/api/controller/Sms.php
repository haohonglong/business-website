<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Cache;

class Sms
{
    public function sendSms(Request $request)
    {
        $phone = $request->param('phone', 0);

        if (!$phone) {
            return ['code' => 1, 'msg' => '请填写手机号'];
        }

        $code = mt_rand(100000, 999999);
        Cache::set('phone'.$phone, $code, 120);
        $result = sendMsg($phone, $code);
        //$result['Code'] = 'OK';
        if ($result['Code'] == 'OK') {
            // cache('tel' . , $code, 39);
            return ['code' => 0, 'msg' => '成功', 'data' => $code];
        }
        return ['code' => 1, 'msg' => '发送失败'];
    }

    public function checkSmsCode(Request $request) {
        $code = $request->param('code', 0);
        $phone = $request->param('phone', 0);

        if (!$code || !$phone) {
            return ['code' => 1, 'msg' => '手机号或验证码错误'];

        }

        $tmpcode = Cache::get('phone'. $phone);

        if ($tmpcode == $code) {
            return ['code' => 0, 'msg' => '成功', 'data' => ['phone'=>$phone,'code'=>$code]];
        }
        return ['code' => 1, 'msg' => '验证码失效'];

    }

}
