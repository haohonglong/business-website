<?php

namespace app\admincp\controller;

use app\admincp\model\App;
use app\admincp\model\User;
use app\admincp\model\Order;
use think\Db;
use think\Request;
use think\Cookie;
use app\admincp\model\Xinxiz;
use app\admincp\model\Xixin;
use library\Helper;

class Index extends Base {

    public function index() {

		$request = request::instance();

		$keyword = $request->param('keyword','');//姓名
		$phone = $request->param('phone','');
		$post = $request->param('post','');
		$unit = $request->param('unit','');

		if($keyword != ''){
			$where['name'] = ['like', "%$keyword%"];
		}
		if($phone != ''){
			$where['phone'] = ['like', "%$phone%"];
		}
		if($unit != ''){
			$where['unit'] = ['like', "%$unit%"];
		}
		if($post != ''){
			$where['post'] = ['like', "%$post%"];
		}



		// if ($keyword) {
		// 	$where['name'] = ['like', "%$keyword%"];
			
		// }
		
		$list = Xixin::where($where)->select();
		$this->assign('userList',$list);
		$this->assign('keyword',$keyword);
		$this->assign('phone',$phone);
		$this->assign('post',$post);
		$this->assign('unit',$unit);
    	// $appInfo = new App();
   		// $loginInfo = $appInfo->getLoginInfo();

   		// $openId = $loginInfo['openId'];
   		// $appId = $loginInfo['appId'];
   		// $username = $loginInfo['username'];
   		// $uid = $loginInfo['uid'];

    	// $appList = array();
    	// $qrcodeUrl = '';
   		// if($loginInfo['loginType'] == 'WX') {

   		// 	$request = Request::instance();
	    // 	$authCode = $request->param('auth_code');
	    // 	$appId = $request->param('appid');

   		// 	if($appId) {
   		// 		$where = array(
		// 			'wxopenid' => $openId,
		// 			'appid' => $appId
		// 		);

	    // 		$appInfo = App::where($where)->find();

	    // 		if($appInfo) {

	    // 			$cookiesValue = Helper::authcode("$username\t$uid\t$openId\t$appId\tMP", 'ENCODE');
	    // 			Cookie::set('feeyanAdmin', $cookiesValue);

	    // 			$this->redirect('/admincp');

	    // 		} else {

	    // 			Cookie::delete('feeyanAdmin');
	    // 			$this->redirect('/admincp/Login');

	    // 		}
   		// 	}

    	// 	$qrcodeUrl = $wxInfo = '';

	    // 	$preAuthCode = Helper::getPreAuthCode();
		//     $callbackUrl = urlencode('https://debug.oa.feeyan.com/framework/admincp/');
		//     $preAuthCode = urlencode($preAuthCode);

		//     	// $qrcodeUrl = 'https://mp.weixin.qq.com/safe/bindcomponent?action=bindcomponent&auth_type=1&no_scan=1&component_appid=wx552272bb2681754b&pre_auth_code='.$preAuthCode.'&redirect_uri='.$callbackUrl;

		//     $qrcodeUrl = 'https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid=wx552272bb2681754b&pre_auth_code='.$preAuthCode.'&redirect_uri='.$callbackUrl.'&auth_type=2';

	    // 	$authCodeInfo = Helper::getQueryAuth($authCode);

	    // 	if(isset($authCodeInfo['authorization_info'])) {
	    // 		$wxappid = $authCodeInfo['authorization_info']['authorizer_appid'];
		//     	$wxInfo = Helper::getWxInfo($wxappid);

		//     	$where = array(
		//     		'wxappid' => $wxappid,
		//     		'wxopenid' => $openId
		//     	);

		//     	$appInfo = App::where($where)->find();

		//     	if($appInfo) {

		//     		$update = array(
		//     			'status' => 1,
		//     			'refreshtoken' => $wxInfo['authorization_info']['authorizer_refresh_token']
		//     		);

		//     		App::where($where)->update($update);

		//     	} elseif(isset($wxInfo['authorizer_info'])) {
		//     		$postData = array(
		//     			'appid' => Helper::createRandomStr(32),
		//     			'name' => $wxInfo['authorizer_info']['nick_name'],
		//     			'wxopenid' => $openId,
		//     			'wxappid' => $wxappid,
		//     			'refreshtoken' => $wxInfo['authorization_info']['authorizer_refresh_token'],
		//     			'status' => 1,
		//     			'comment' => json_encode($wxInfo)
		//     		);

		//     		App::create($postData);
		//     	}
	    // 	}

	    // 	$where = array(
		// 		'wxopenid' => $openId
		// 	);

    	// 	$appList = App::where($where)->order('id desc')->select();

   		// } else {
   		// 	$where = array(
		//        'appid' => $appId,
		//        'status' => 0
		//     );

   		// 	$list = Order::with('comments')->where($where)->order('create_time desc')->limit(10)->select();

		//     $orderList = array();

		//     foreach($list as $k=>$v) {
		//         $item = [
		// 		  'id' => $v['id'],
		// 		  'title' => $v['title'],
		//           'orderSn' => $v['sn'],
		//           'stauts'  => $v['status'],
		//           'status_name' => self::statusName($v['status']),
		//           'buyername' => $v['comments']['name'],
		//           'payprice' => $v['payprice'],
		//           'paytime'  => $v['comments']['pay_time'] ? date('Y-m-d H:i', $v['comments']['pay_time']) : '',
		//           'create_time' => date('Y-m-d H:i', strtotime($v['create_time'])),
		//         ];
		//         $orderList[$k] = $item;
		//    	}

		//     $where = array(
		//         'appid' => $appId
		//     );

		//     $userList = User::where($where)->order('create_time desc')->limit(8)->select();
   		// }

   		// $this->assign('appList', $appList);
	    // $this->assign('qrcodeUrl', $qrcodeUrl);
	    // $this->assign('orderList', $orderList);
      	// $this->assign('userList', $userList);
    	$this->assign('title','信息管理首页');
      	return $this->fetch();
      
    }

    public function returnlist() {

    	$appInfo = new App();
   		$loginInfo = $appInfo->getLoginInfo();

   		$openId = $loginInfo['openId'];
   		$username = $loginInfo['username'];
   		$uid = $loginInfo['uid'];

   		$cookiesValue = Helper::authcode("$username\t$uid\t$openId\t\tWX", 'ENCODE');
	    Cookie::set('feeyanAdmin', $cookiesValue);

	    $this->redirect('/admincp');

    }

    static public function statusName($key) {
        $data = [
            0 => '待付款',
            1 => '待发货',
            2 => '已发货',
            3 => '已收货',
            4 => '申请退款',
            5 => '退款成功',
            6 => '退款失败', 
            7 => '订单关闭',
        ];

        return $data[$key];
    }

}
