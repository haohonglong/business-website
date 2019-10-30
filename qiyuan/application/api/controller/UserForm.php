<?php

namespace app\api\controller;

use app\api\model\UserForm as UForm;
use think\Config;
use think\Request;
use think\Cache;

class Userform
{


    public function index(Request $request) {
        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');

        $sort = $request->param('sort', 0);
        $rid  = $request->param('id', 0);
        $formId = $request->param('formId', '');

        if (!$formId || $formId == 'undefined' || $formId == 'the formId is a mock one') {
            return ['code' => 1, 'msg' => 'formId错误'];
        }

        $userData = Cache::get($userSession);
        if (!$userData) {
            return ['code' => 1, 'msg' => '用户不存在'];
        }

        $uid = $userData['userInfo']['uid'];
        $openId = $userData['openId'];

        $data = [
            'uid' => $uid,
            'openid' => $openId,
            'formid' => $formId,
            'rid' => $rid,
            'sort' => $sort,
        ];

        $userForm = UForm::where([
            'uid' => $uid,
            'openid' => $openId,
            'rid' => $rid,
            'sort' => $sort,
        ])->find();

        if (!$userForm) {
            $rt = UForm::create($data);

        } else {
            $userForm->formid = $formId;
            $userForm->sort = $sort;
            $userForm->rid = $rid;
            $userForm->is_used = 0;
            $rt = $userForm->save();
        }


        return ['code' => 0, 'msg' => '成功', 'data' => $rt];

    }
}
