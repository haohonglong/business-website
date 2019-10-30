<?php

namespace app\admincp\controller;

use app\admincp\model\User;
use app\admincp\model\Adminuser;
use think\Controller;
use think\Db;
use think\Request;
use think\Cookie;

class Base extends Controller {

	public function _initialize() {
		$request = Request::instance();
		$action = $request->controller();

		$adminUserCookies = Cookie::get('feeyanAdmin');
		$id = '';
		$username = '';
		if($adminUserCookies) {
			list($id, $username) = explode("\t", authcode($adminUserCookies, 'DECODE'));
		}

		$PluginName = array('Plugin', 'Group', 'Lottery');
		$this->assign('PluginName', $PluginName);
		$this->assign('type', 'MP');
		if(!in_array($action, array('Login','logout'))) {
			$this->checkAdmin($id, $username);
		}
    }

    public function checkAdmin($id, $username) {
		$where = array(
		   	'id' => $id,
		    'username' => $username
		);

		$adminUserData = Adminuser::where($where)->find();

	    if(empty($adminUserData['id'])) {
	    	$this->redirect('/admincp/Login');
	    } else {
	    	$adminUserData['username'] = $username;
	    }

	    //$uncheckedData = $this->getUncheckedInfo($appId);

	    $this->assign('userInfo', $adminUserData->toArray());
	    //$this->assign('uncheckedData', $uncheckedData);
	}

    public function checkPermission($uid, $action, $appId) {

    	
    }

}