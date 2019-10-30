<?php

namespace app\admincp\model;

use think\Model;

class App extends Model
{
    public function getLoginInfo() {
        $adminUserCookies = cookie('feeyanAdmin');

		list($username, $uid, $openId, $appId, $type) = explode("\t", authcode($adminUserCookies, 'DECODE'));

		$returnData = array(
			'username' => $username,
			'uid' => $uid,
			'openId' => $openId,
			'appId' => 'd6mBDb2J9fvT43XiKRhUu8toageH7cwS',
			'loginType' => $type
		);

		return $returnData;          
    }
    
}
