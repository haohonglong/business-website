<?php
namespace app\api\controller;
use app\api\model\Category;
use app\api\model\Resource;
use app\api\model\ResourceProduct;
use app\api\model\ResourceProductSku;
use app\api\model\ResourceProductCategory;
use app\api\model\ResourceProductGroup;
use app\api\model\ProductGroupUser;
use app\api\model\ProductGroup;
use app\api\model\Order as Od;
use app\api\model\OrderComment as OdComment;
use app\api\model\OrderProduct as OdProduct;
use app\api\model\Setting;
use think\Config;
use think\Request;
use think\Cache;
use think\Db;

class Group
{
    public function index()
    {
        $request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', 'd6mBDb2J9fvT43XiKRhUu8toageH7cwS', 'htmlspecialchars');

        $page = $request->param('page', 1, 'intval');
        $pageSize = 10;

        $where = array(
            'appid' => $appId,
            'status' => 0,
            // 'istop' => 1,
            'goodssort' => 0,
        );

        

        $field = array(
            'id',
            'sort', 
            'categoryid', 
            'title',
            'cover', 
            'summary', 
            'url', 
            'price', 
            'original_price',
            'stock', 
            'salecount', 
            'views', 
            'replies', 
            'likes', 
            'isrecommend',
            'goodssort'
        );

        $resourceList = Resource::where(['appid' => $appId, 'status' => 0, 'goodssort' => 0])->page($page, $pageSize)->order('istop desc,create_time desc')->field($field)->select();

        $returnData['total'] = Resource::where(['appid' => $appId, 'status' => 0, 'goodssort' => 0])->count();
        $returnData['page'] = $page;
        $returnData['size'] = $pageSize;

        $groupList = Resource::with('group')->where(['appid' => $appId, 'status' => 0, 'goodssort' => 1])->order('istop desc,create_time desc')->limit(5)->select();

        $where = array(
            'appid' => $appId,
            'status' => 0,
            'keyword' => 'swiper'
        );

        $swiperData = Setting::where($where)->column('value');

        $swiperList = array();
        foreach ($swiperData as $key => $swiper) {
            $swiper = json_decode($swiper, TRUE);
            $swiperList[$key]['cover'] = $swiper['cover'];
            $swiperList[$key]['link'] = '/'.$swiper['link'];
        }
        $returnData['swiperList'] = $swiperList;
        $returnData['list'] = $resourceList;

        foreach ($groupList as $k => $v) {
            $groupList[$k]['price'] = $v['original_price'];
        }
        $returnData['groupList'] = $groupList;

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }


    public function detail()
    {
        $request = Request::instance();

        $appid = $request->param('appId', '');
        $userSession = $request->param('userSession', '');
        $order_sn = $request->param('orderSn', '');

        $userData = Cache::get($userSession);
        $uid = $userData['userInfo']['uid'];

        $order = Od::where(['sn' => $order_sn])->find();

        $group = ProductGroup::where(['id' => $order->groupid])->find();

        if(!$group) {
           return ['code' => 1,'msg' => '拼团不存在'];
        }

        $returnData['groupId'] = $group['id'];
        $returnData['joinnum'] = $group['joinnum'];
        $returnData['remainnum'] = $group['remainnum'];

        $returnData['status'] = $group['endtime'] < time() ? 0 : $group['status'];
        $returnData['endtime'] = date('Y-m-d H:i:s', $group['endtime']);
        $returnData['goodsId'] = $group['rid'];

        $orderGoods = OdProduct::where([
            'oid' => $order['id']
        ])->find();

        $returnData['goodsName'] = $orderGoods['title'];
        $returnData['goodsCover'] = $orderGoods['cover'];
        $returnData['goodsPrice'] = $orderGoods['price'];
        $returnData['createTime'] = $orderGoods['create_time'];

        $orderGoods = ProductGroupUser::where([
            'groupid' => $group['id'],
            'status' => 1
        ])->select();

        $joinList = $joinUidList = array();

        foreach ($orderGoods as $value) {
            $joinUidList[] = $value['joinuid'];
        }

        $returnData['is_join'] = in_array($uid, $joinUidList) ? 1 : '';

        for ($i = 0; $i < $group['joinnum']; $i++) {
            if(isset($orderGoods[$i])) {
                $joinList[$i]['avatar'] = $orderGoods[$i]['joinavatar'];
                $joinList[$i]['isfounder'] = $orderGoods[$i]['isfounder'];
            } else {
                $joinList[$i]['avatar'] = '';
                $joinList[$i]['isfounder'] = '';
            }
        }

        $returnData['joinList'] = $joinList;

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }
}
