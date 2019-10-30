<?php

namespace app\admincp\controller;
use app\admincp\model\App;
use app\admincp\model\Order as Od;
use app\admincp\model\OrderComment;
use think\Request;
use think\Db;

class Order extends Base {

    public function index() {

    	$appInfo = new App();
      $loginInfo = $appInfo->getLoginInfo();

      $openId = $loginInfo['openId'];
      $appId = $loginInfo['appId'];
      $username = $loginInfo['username'];
      $uid = $loginInfo['uid'];

      $request = Request::instance();

    	$keyword = $request->param('keyword', '', 'htmlspecialchars');
      $status = $request->param('status', '-1');
    //return $status;
      $where['appid'] = $appId;

      if($keyword) {
        $where['sn'] = ['like', "%$keyword%"];
      }

      if($status >= 0) {
        $where['status'] = $status;
      }

      for ($i = -1; $i < 8; $i++) { 
        $select[$i] = $status == $i ? 'active' : '';
      }
      
      $list = Od::with('comments')->where($where)->order(['id'=>'desc'])->paginate(20, false, [
          'query' => $request->param(),
      ]);

      $resourceList = $list->items();
      //var_dump($resourceList) ;
      $total = $list->total();
      $page = $list->render();

      $returnList = array();

      foreach($resourceList as $key => $value) {
        $item = [
          'id' => $value['id'],
          'orderSn' => $value['sn'],
          'feright' => $v['comments']['freight'],
          'stauts'  => $value['status'],
          'status_name' => self::statusName($value['status']),
          'payprice' => $value['payprice'],
          'buyername' => $value['comments']['name'],
          'buyeraddress' => $value['comments']['address'],
          'buyertel' => $value['comments']['tel'],
          'paytime'  => $value['comments']['pay_time'] ? date('Y-m-d H:i', $v['comments']['pay_time']) : '',
          'create_time' => date('Y-m-d H:i', strtotime($value['create_time'])),
        ];
        $returnList[$key] = $item;
      }

      $this->assign('orderList', $returnList);
      $this->assign('page', $page);
      $this->assign('total', $total);
      $this->assign('keyword', $keyword);
      $this->assign('status', $status);
      $this->assign('select', $select);

      $this->assign('title','订单管理');
      return $this->fetch();
    
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
            8 => '待成团',
            9 => '拼团失败',
        ];

        return $data[$key];

    }

    //关闭订单
    public function del(){
        $order = new Od();
        $request = Request::instance();
        $id = $request->param('id', '');
        $order->save([
            'status' => '7'
        ],['id' => $id]);
        $this->redirect('Order/index');
    }

    public function detail(Request $request) {
		$appInfo = new App();
		$loginInfo = $appInfo->getLoginInfo();

		$openId = $loginInfo['openId'];
		$appId = $loginInfo['appId'];
		$username = $loginInfo['username'];
		$uid = $loginInfo['uid'];

		$sn = $request->param('sn', '');

		$model = Od::where(['appid' => $appId, 'sn' => $sn])->find();

		$this->assign('model', $model);
		return $this->fetch();
	}

	public function addExpress(Request $request) {
		$appInfo = new App();
		$loginInfo = $appInfo->getLoginInfo();

		$openId = $loginInfo['openId'];
		$appId = $loginInfo['appId'];
		$username = $loginInfo['username'];
		$uid = $loginInfo['uid'];

		$orderSn = $request->param('sn', '');
		$name = $request->param('name', '');
		$num = $request->param('num', '');

		if ($appId) {
			$order = Od::where(['appid' => $appId, 'sn' => $orderSn])->find();
			$orderComment = OrderComment::where(['oid' => $order->id])->find();
			if (!$order || !$orderComment) {
				return json_encode(['error' => '订单信息错误']);
			}

			if ($order->status > 2) {
				return json_encode(['error' => '订单已发货']);
			}
			$orderComment->expressname = $name;
			$orderComment->expressnum = $num;
			$orderComment->save();
			$order->status = 2;
			$order->save();
			return json_encode(['sn' => $orderSn]);

		} else {
			return json_encode(['error' => 'appid不存在']);
		}


  	}
}
