<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\Permission;
use think\Request;
use think\Db;

class User extends Base {

    public function index() {

    	$appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];
      $uid = $loginInfo['uid'];

      $keyword = Request::instance()->param('keyword', '');

   		$where['appid'] = $appId;

   		if ($keyword) {
   		 $where['username'] = ['like', "%$keyword%"];
      }

   		$list = Db::name('user')->where($where)->order(['id'=>'desc'])->paginate(20);

   		$userList = $list->items();
   		$total = $list->total();
   		$page = $list->render();

      $modulePermission = array(
        array('name' => '用户管理', 'controller' => 'usermanage', 'action' => ''),
        array('name' => '资讯管理', 'controller' => 'resmanage', 'action' => ''),
        array('name' => '商品管理', 'controller' => 'product', 'action' => ''),
        array('name' => '订单管理', 'controller' => 'ordermanage', 'action' => ''),
        array('name' => '页面设置', 'controller' => 'page', 'action' => ''),
      );

      $this->assign('modulePermission', $modulePermission);
      $this->assign('userList', $userList);
      $this->assign('page', $page);
      $this->assign('total', $total);
      $this->assign('keyword', $keyword);

    	$this->assign('title','用户管理');
      return $this->fetch();
    
    }

    public function permission() {

      $appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];
      $uid = $loginInfo['uid'];

      $request = Request::instance();

      $uid = $request->param('uid', '', 'intval');

      $where = array(
         'appid' => $appId,
         'uid' => $uid
      );

      $getUserPermission = Permission::where($where)->order('create_time desc')->column('controller');

    }

    public function edit() {

      $appInfo = new AppInfo();
      $appId = $appInfo->getAppId();

      $where['appid'] = $appId;

      $request = Request::instance();

      $basicPermission = array(
        'User' => '用户管理'
      );

      $uid = $request->param('id', '', 'intval');

      $where['id'] = $uid;

      $userData = User::where($where)->find();

      $this->assign('uid', $uid);
      $this->assign('appId', $appId);
      $this->assign('userData', $userData);
      $this->assign('title','-用户管理');
      return $this->fetch();

    }

}
