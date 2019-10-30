<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use think\Request;
use think\Db;

class Material extends Base {

    public function index() {

    	$appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];

      $keyword = Request::instance()->param('keyword', '');

   		$where['appid'] = $appId;
   		if ($keyword) {
   		 $where['username'] = ['like', "%$keyword%"];
      }
   		$list = Db::name('user')->where($where)->order(['id'=>'desc'])->paginate(20);

   		$userList = $list->items();
   		$total = $list->total();
   		$page = $list->render();
      
      $this->assign('userList', $userList);
      $this->assign('page', $page);
      $this->assign('total', $total);
      $this->assign('keyword', $keyword);

    	$this->assign('title','-营销组件');
      return $this->fetch();
    
    }

}
