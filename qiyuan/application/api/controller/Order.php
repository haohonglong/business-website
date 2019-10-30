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
use app\api\model\PaymentLog;
use think\Config;
use think\Request;
use think\Cache;
use think\Db;
use wxpay\Wxpay;
use library\Helper;
use think\Log;

class Order
{
    public function index()
    {
    	$request = Request::instance();
        
        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');
        $status = $request->param('status', '');

        $page = $request->param('page', 1, 'intval');
        $pageSize = 10;

        $userData = Cache::get($userSession);
        if (!$userData) {
            return ['code' => 1, 'msg' => '用户不存在'];
        }

        $uid = $userData['userInfo']['uid'];

        $where = array(
            'appid' => $appId,
            'buyer' => $uid
        );

        if(is_numeric($status)) {
            $where['status'] = intval($status);
        }

        $returnData['total'] = Od::where($where)->count();
        $returnData['page'] = $page;
        $returnData['size'] = $pageSize;

        $orderList = Od::where($where)->page($page, $pageSize)->order('create_time desc')->select();

        $statusList = [
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

        foreach ($orderList as $key => $value) {
            $returnData['list'][$key]['id'] = $value['id'];
            $returnData['list'][$key]['sn'] = $value['sn'];
            $returnData['list'][$key]['title'] = $value['title'];
            $returnData['list'][$key]['cover'] = $value['cover'];
            $returnData['list'][$key]['sku'] = $value['sku'];
            $returnData['list'][$key]['payPrice'] = $value['payprice'];
            $returnData['list'][$key]['status'] = $value['status'];
            $returnData['list'][$key]['statusText'] = $statusList[$value['status']];
        }

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }

    public function create()
    {
        $request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');

        $goodsList = $request->param('goodsList');
        $username = $request->param('username', '', 'htmlspecialchars');
        $tel = $request->param('tel', '', 'htmlspecialchars');
        $provinceName = $request->param('provinceName', '', 'htmlspecialchars');
        $address = $request->param('address', '', 'htmlspecialchars');
        $message = $request->param('message', '', 'htmlspecialchars');
        $formId = $request->param('formId', '', 'htmlspecialchars');
        $isFounder = $request->param('isFounder', '', 'intval');
        $groupId = $request->param('groupId', '', 'intval');
        $uid = $request->param('uid', '', 'intval');

        if (!$appId || !$userSession) {
            return ['code' => 1,'msg' => '参数错误'];
        }
            
        $userData = Cache::get($userSession);
        if (!$userData) {
            return ['code' => 1, 'msg' => '用户不存在'];
        }

        $openId = $userData['openId'];

        if (!$goodsList) {
            return ['code' => 1,'msg' => '未选择商品'];
        }

        $goodsList = json_decode($goodsList, TRUE);

        $goodsInfoList = array();
        $totalprice = $totalnum = 0;

        foreach ($goodsList as $key => $goods) {
            $gid = $goods['id'];
            $skuId = isset($goods['skuId']) ? $goods['skuId'] : 0;
            $num = $goods['num'];

            if(!$num) {
                return ['code' => 1, 'msg' => '请选择购买数量'];
            }

            $where = array(
                'id' => $gid,
                'appid' => $appId
            );

            $goodsInfo = Resource::where($where)->find();
            $shipprice = ResourceProduct::where(['rid' => $gid])->value('shipprice');

            if($goodsInfo['goodssort'] == 1) {
                $where = array(
                    'rid' => $gid
                );


                $goodsGroup = ResourceProductGroup::where($where)->field('price, joinnum')->find();
            }


            if(!$goodsInfo) {
                return ['code' => 1, 'msg' => '商品信息错误'];
            } else {

                if($skuId) {
                    $where = array(
                        'id' => $skuId,
                        'rid' => $gid
                    );

                    $goodsSkuList = ResourceProductSku::where($where)->column('id, attr, price, stock, groupprice');
                } else {
                    $goodsSkuList = '';
                }
                
                if($goodsSkuList) {
                    $price = $groupId || $isFounder ? $goodsSkuList[$skuId]['groupprice'] : $goodsSkuList[$skuId]['price'];

                    $stock = $goodsSkuList[$skuId]['stock'] - $num;
                    $totalPrice = $price * $num;
                    $price = $price;
                    $skuName = $goodsSkuList[$skuId]['attr'];

                    if(!$goodsSkuList) {
                        return ['code' => 1, 'msg' => '请选择商品规格'];
                    }
                } else {

                    $price = $groupId || $isFounder ? $goodsGroup['price'] : $goodsInfo['price'];
                    $stock = $goodsInfo['stock'] - $num;
                    $totalPrice = $price * $num;
                    $skuName = '';
                }

                if($stock < 0) {
                    return ['code' => 1, 'msg' => '商品已售罄'];
                }
            }

            $goodsInfoList[$key]['id'] = $goodsInfo['id'];
            $goodsInfoList[$key]['cover'] = $goodsInfo['cover'];
            $goodsInfoList[$key]['title'] = $goodsInfo['title'];
            $goodsInfoList[$key]['price'] = $price;
            $goodsInfoList[$key]['num'] = $num;
            $goodsInfoList[$key]['skuId'] = $skuId;
            $goodsInfoList[$key]['skuName'] = $skuName;

            $totalPrice = $totalPrice + $shipprice;
            $totalprice += $totalPrice;
            $totalnum += $num;
        };

        if($goodsInfo['goodssort'] == 1 && $isFounder) {
            $where = array(
                'rid' => $gid
            );

            $goodsGroup = ResourceProductGroup::where($where)->field('price, joinnum')->find();
        }

        $orderSn = 'FY'.date('YmdHis').substr(microtime(),2,5).rand(100000, 999999);

        $data['orderSn'] = $orderSn;

        if($groupId) {
            $groupInfo = ProductGroup::where(['id' => $groupId])->find();

            if(!$groupInfo) {
                return ['code' => 1,'msg' => '拼团不存在'];
            }

            if($groupInfo['remainnum'] == 0) {
                return ['code' => 1,'msg' => '拼团已满'];
            }

            if($groupInfo['status'] == 0 || $groupInfo['endtime'] < time()) {
                return ['code' => 1,'msg' => '拼团已过期'];
            }

            if($groupInfo['status'] == 2) {
                return ['code' => 1,'msg' => '拼团已结束'];
            }

            $userInfo = \app\api\model\ProductGroupUser::where([
                'groupid' => $groupId,
                'joinuid' => $userData['userInfo']['uid']
            ])->find();

            if($userInfo) {
                return ['code' => 1,'msg' => '您已经参加过拼团'];
            }

            $data['groupid'] = $groupId;
            $data['orderSn'] = $groupInfo['sn'];

        }

        Db::startTrans();
        try{
            if($isFounder) {
                $group = ProductGroup::create([
                    'appid' => $appId,
                    'sn' => $orderSn,
                    'rid' => $goods['id'],
                    'founderuid' => $userData['userInfo']['uid'],
                    'joinnum' => $goodsGroup['joinnum'],
                    'remainnum' => $goodsGroup['joinnum'],
                    'starttime' => time(),
                    'endtime' => time() + 86400,
                    'status' => 0
                ]);

                $is_founder = 1;
                $data['groupid'] = $group['id'];

            } else {
                $is_founder = 0;
            }

            $groupInfo = array();

            if($groupId || $isFounder) {
                $groupInfo = ProductGroupUser::create([
                    'appid' => $appId,
                    'groupid' => $data['groupid'],
                    'joinuid' => $userData['userInfo']['uid'],
                    'joinavatar' => $userData['userInfo']['avatar'],
                    'isfounder' => $is_founder,
                    'status' => 1
                ]);
            }

            $postData = array(
                'appid' => $appId,
                'sn' => $orderSn,
                'buyer' => $userData['userInfo']['uid'],
                'status' => 0,
                'payprice' => $totalprice,
                'totalnum' => $totalnum,
                'cover' => $goodsInfoList[0]['cover'],
                'title' => $goodsInfoList[0]['title'],
                'sku' => $goodsInfoList[0]['skuName'],
                'goodsnum' => count($goodsList)
            );

            if($groupInfo) {
                $postData['sort'] = $data['groupid'] ? 1 : 0;
                $postData['groupid'] = $data['groupid'];
            }

            $order = Od::create($postData);

            $postData = array(
                'oid' => $order['id'],
                'name' => $username,
                'address' => $address,
                'tel' => $tel,
                'memo' => $message,
                'shipprice' => 0
            );

            OdComment::create($postData);

            foreach ($goodsInfoList as $value) {
                $postData = array(
                    'oid' => $order['id'],
                    'rid' => $value['id'],
                    'cover' => $value['cover'],
                    'title' => $value['title'],
                    'price' => $value['price'],
                    'num' => $value['num'],
                    'skuid' => $value['skuId'],
                    'skuname' => str_replace('_', ' ', $value['skuName'])
                );

                OdProduct::create($postData);
            }

            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['code' => 1,'msg' => '创建订单错误'];
        }

        $wxpay = new Wxpay();
        // $resultArr = $wxpay->unifiedorder($params);
        $nonceStr = Helper::createRandomStr(32);
        $params = [
            'orderSn' => $orderSn,
            'openid' => $openId,
            'payAmount' => $totalprice,
            'nonceStr' => $nonceStr,
        ];

        $resultArr = self::unifiedorder($params, $wxpay);

        if ($resultArr['return_code'] == 'SUCCESS' && isset($resultArr['result_code']) && $resultArr['result_code'] == 'SUCCESS') {
            $order->prepay_id = $resultArr['prepay_id'];
            $order->save();

            $rtData = [
                'appId' => $resultArr['appid'],
                'timeStamp' => time(),
                'nonceStr' => $nonceStr,
                'package' => 'prepay_id='.$resultArr['prepay_id'],
                'signType' => 'MD5'
            ];
            $paySign = $wxpay->generateSign($rtData);
            $rtData['paySign'] = $paySign;
            $rtData['orderSn'] = $orderSn;

        } else {
            return ['code' => 1, 'msg' => $resultArr['return_msg']];
        }

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $rtData
        ];
    }

    public function orderPay()
    {
        $request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');

        $orderSn = $request->param('orderSn', '');

        if (!$appId || !$userSession || !$orderSn) {
            return ['code' => 1,'msg' => '参数错误'];
        }

        $userData = Cache::get($userSession);
        if (!$userData) {
            return ['code' => 1, 'msg' => '用户不存在'];
        }

        $uid = $userData['userInfo']['uid'];
        $openId = $userData['openId'];

        $order = Od::where([
            'appid' => $appId,
            'buyer' => $uid,
            'sn' => $orderSn
        ])->field(['id, payprice, groupid'])->find();

        //查看库存
        $goodsList = OdProduct::where([
            'oid' => $order['id']
        ])->select();

        $totalPrice = 0;

        foreach($goodsList as $val){

            $map['id'] = $val['rid'];
            $goods = Resource::where($map)->field(['stock, price'])->find();
            $shipprice = ResourceProduct::where(['rid' => $val['rid']])->value('shipprice');

            if(empty($goods)){
                return ['code' => 1,'msg' => '商品不存在'];
            } else {
                if($val['skuid'] == 0) {
                    if($order['groupid']) {

                        $where = array(
                            'rid' => $val['rid']
                        );

                        $goodsGroup = ResourceProductGroup::where($where)->field('price, joinnum')->find();
                        $price = $goodsGroup['price'];

                    } else {

                        $price = $goods['price'];

                    }

                    $stock = $goods['stock'] - $val['num'];
                    $total = $price * $val['num'];
                    $totalPrice = $totalPrice + $total + $shipprice;

                } else {

                    $where = array(
                        'id' => $val['skuid'],
                        'rid' => $val['rid']
                    );

                    $goodsSkuList = ResourceProductSku::where($where)->column('id, attr, price, stock, groupprice');

                    $skuId = $val['skuid'];
                    $price = $order['groupid'] ? $goodsSkuList[$skuId]['groupprice'] : $goodsSkuList[$skuId]['price'];

                    $stock = $goodsSkuList[$skuId]['stock'] - $val['num'];
                    $totalPrice = $price * $val['num'] + $shipprice;

                }

                if($stock < 0){
                    return ['code' => 2,'msg' => '你有商品库存不够'];
                }
            }

        }

        if ($order['payprice'] != $totalPrice) {
            return ['code' => 1,'msg' => '总金额不符'];
        }

        $wxpay = new Wxpay();
        // $resultArr = $wxpay->unifiedorder($params);
        $nonceStr = Helper::createRandomStr(32);
        $params = [
            'orderSn' => $orderSn,
            'openid' => $openId,
            'payAmount' => $totalPrice,
            'nonceStr' => $nonceStr,
        ];

        $resultArr = self::unifiedorder($params, $wxpay);

        if ($resultArr['return_code'] == 'SUCCESS' && isset($resultArr['result_code']) && $resultArr['result_code'] == 'SUCCESS') {
            $order->prepay_id = $resultArr['prepay_id'];
            $order->save();

            $rtData = [
                'appId' => $resultArr['appid'],
                'timeStamp' => time(),
                'nonceStr' => $nonceStr,
                'package' => 'prepay_id='.$resultArr['prepay_id'],
                'signType' => 'MD5'
            ];
            $paySign = $wxpay->generateSign($rtData);
            $rtData['paySign'] = $paySign;
            $rtData['orderSn'] = $orderSn;

        } else {
            return ['code' => 1, 'msg' => $resultArr['return_msg']];
        }

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $rtData
        ];
    }

    static private function unifiedorder($data, $wxpay) {
        
        $ip = Request::instance()->ip();

        $params = [
            'nonce_str' => $data['nonceStr'],
            'body' => '飞燕',
            'out_trade_no' => $data['orderSn'],
            'total_fee' => $data['payAmount'],
            'spbill_create_ip' => $ip,
            'notify_url' => self::getDomainHost() . '/api/order/wxappNotify',
            'trade_type' => 'JSAPI',
            'openid' => $data['openid'],
        ];

        // return ['code' => 0, 'msg' => '成功', 'data' => ['orderSn' => $orderSn]];
        // exit();
        
        $resultArr = $wxpay->unifiedorder($params);
        return $resultArr;

    }

    static private function getDomainHost()
    {
        $domainHost = $_SERVER['HTTP_HOST'];
        // if ($domainHost == 'wxapp.feeyan.com') {
        //     return 'https://wxapp.feeyan.com/app/palace';
        // } elseif ($domainHost == 'debug.oa.feeyan.com') {
        //     return 'https://debug.oa.feeyan.com/palace';
        // } elseif ($domainHost == 'ggwhzb.feeyan.com') {
            return 'https://ggwhzb.feeyan.com';
        //}

    }

    static private function getNotifyData()
    {
        $params = file_get_contents("php://input");
        if($params == null) {
            $params = $GLOBALS['HTTP_RAW_POST_DATA'];
        }
        return $params;
    }

    /**
     * 支付回调
     * @return array
     */
    public function wxappNotify()
    {
        $params = self::getNotifyData();
        if ($params) {
            $data = xmlToArray($params);
            if ($data['return_code'] == 'SUCCESS') {
                $sign = $data['sign'];
                unset($data['sign']);

                $orderSn = $data['out_trade_no'];
                $order = Od::where([
                    'sn' => $orderSn
                ])->find();
                
                $OdComment = OdComment::where(['oid' => $order->id])->find();

                $OdProduct = OdProduct::where(['oid' => $order->id])->select();
               
                // if (!$order) {
                //     Log::record('===========订单错误');
                //     return ['code' => 1, 'msg' => '订单不存在'];
                // }
                $paymentLog = PaymentLog::where([
                    'sn' => $orderSn
                ])->find();
                if (!$paymentLog) {
                    $paymentLog = PaymentLog::create([
                        'appid' => $order->appid,
                        'sn' => $data['out_trade_no'],
                        'tid' => $data['transaction_id'],
                        'result' => json_encode($data)
                    ]);
                }
                $wxpay = new Wxpay();
                $signTemp = $wxpay->generateSign($data);
                if ($signTemp == $sign) {
                    if ($order['paystatus']) {
                        $this->returnSuccess();
                    } else {
                        Db::startTrans();
                        try{
                            $status = 1;

                            if($order['groupid']) {
                                $groupInfo = \app\api\model\ProductGroup::where([
                                    'id' => $order['groupid']
                                ])->find();

                                $update['remainnum'] = $groupInfo['remainnum'] - 1;
                                $update['status'] = $update['remainnum'] == 0 ? 2 : 1;

                                \app\api\model\ProductGroup::where([
                                    'id' => $order['groupid']
                                ])->update($update);

                                $updateUser['status'] = 1;

                                \app\api\model\ProductGroupUser::where([
                                     'groupid' => $order['groupid'],
                                     'joinuid' => $order['buyer']
                                ])->update($updateUser);

                                $status = $update['remainnum'] == 0 ? 1 : 8;
                                if ($status == 1) {
                                    $groupOrder = Od::where(['appid' => $order->appid, 'groupid' => $order->groupid, 'status' => 8])->update(['status' => $status]);
                                }
                                
                            }

                            $order->status = $status;
                            $order->paystatus = 1;
                            $order->save();

                            $OdComment->pay_time = time();
                            $OdComment->save();

                            foreach($OdProduct as $k => $v) {
                                if($v['skuid'] == 0) {
                                    Resource::where(['id' => $v['rid']])->setDec('stock', $v['num']);
                                } else {
                                    ResourceProductSku::where(['id' => $v['skuid']])->setDec('stock', $v['num']);
                                }
                            }
                            Db::commit();

                            //返回成功状态
                            $this->returnSuccess();
                        } catch (\Exception $e) {
                            // 回滚事务
                            Db::rollback();
                        }
                    }
                } else {
                    Log::record('===========签名错误');
                    return ['code' => 1, 'msg' => '签名错误'];
                }
            }
        } else {
            return ['code' => 1, 'msg' => '参数错误'];
        }
    }

    private function returnSuccess()
    {
        $return['return_code'] = 'SUCCESS';
        $return['return_msg'] = 'OK';
        $xml = arrayToXml($return);
        echo $xml;
        exit;
    }


    
    public function detail()
    {
        $request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');

        $goodsList = $request->param('goodsList');
        $orderSn = $request->param('orderSn', '', 'htmlspecialchars');

        if (!$appId || !$userSession || !$orderSn) {
            return ['code' => 1,'msg' => '参数错误'];
        }
            
        $userData = Cache::get($userSession);
        if (!$userData) {
            return ['code' => 1, 'msg' => '用户不存在'];
        }

        $uid = $userData['userInfo']['uid'];

        $where = array(
            'appid' => $appId,
            'sn' => $orderSn,
        );

        $returnData['info'] = Od::where($where)->field('id, sn, buyer, status, paystatus, payprice, totalnum, create_time')->find();

        if($uid != $returnData['info']['buyer'] || !$returnData['info']['id']) {
            return ['code' => 1, 'msg' => '订单信息错误'];
        }

        $where = array(
            'oid' => $returnData['info']['id']
        );

        $returnData['comment'] = OdComment::where($where)->field('name, address, tel, memo, shipprice, pay_time, expressname, expressnum')->find();
        $returnData['product'] = OdProduct::where($where)->field('cover, title, price, num, skuname')->select();

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }
}
