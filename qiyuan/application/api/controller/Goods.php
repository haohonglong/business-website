<?php
namespace app\api\controller;
use app\api\model\Category;
use app\api\model\Resource;
use app\api\model\ResourceProduct;
use app\api\model\ResourceProductCategory;
use app\api\model\ResourceProductGroup;
use app\api\model\ResourceProductSku;
use think\Config;
use think\Request;
use think\Cache;

use library\Helper;

class Goods
{
    public function index()
    {
    	
    }

    public function categoryList(Request $request) {
        $appId = $request->param('appId', '', 'htmlspecialchars');
        $list = Category::where(['appid' => $appId, 'status' => 0])->field('id, name')->order('id ASC')->select();
        return ['code' => 0, 'msg' => '成功', 'data' => $list];
    }

    public function lists() 
    {

        $request = Request::instance();
        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');
        $categoryId = $request->param('categoryId', '', 'intval');

        $page = $request->param('page', 1, 'intval');
        $pageSize = 10;

        $where = array(
            'appid' => $appId,
            'sort' => 4,
            'status' => 0
        );

        if($categoryId) {
            $where['categoryid'] = $categoryId;
        }

        $returnData['total'] = Resource::where($where)->count();
        $returnData['page'] = $page;
        $returnData['size'] = $pageSize;

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
            'goodssort',
            'picmode'
        );

        $returnData['list'] = Resource::where($where)->page($page, $pageSize)->order('istop desc,create_time desc')->field($field)->select();

        $where = array(
            'appid' => $appId,
            'sort' => 4,
            'status' => 0,
            'parentid' => 0
        );

        // $returnData['sort'] = Category::where($where)->column('id, name');
        // foreach ($returnData['list'] as $k => $v) {
        //     $returnData['list'][$k]['original_price'] = $v['original_price'] > 0 ? $v['original_price'] : $v['price'];
        // }

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }

    public function detail()
    {
        $request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');

        $gid = $request->param('gid', '', 'intval');
        $skuId = $request->param('skuId', '', 'intval');

        $where = array(
            'id' => $gid,
            'appid' => $appId
        );

        $returnData['goods'] = Resource::where($where)->find();

        $where = array(
            'rid' => $gid
        );

        $returnData['comment'] = ResourceProduct::where($where)->find();
        
        $returnData['coverList'] = json_decode($returnData['comment']['pic'], TRUE);
        $returnData['comment']['description'] = Helper::replaceRichText($returnData['comment']['description']);

        if($returnData['goods']['goodssort'] == 1) {
            $returnData['group'] = ResourceProductGroup::where($where)->field('price, joinnum')->find();
        }

        if(!$skuId) {
            $returnData['sku']['list'] = json_decode($returnData['comment']['sku'], TRUE);
            $productSkuData = ResourceProductSku::where($where)->select();
            $productSku = array();

            if($productSkuData) {
                foreach ($productSkuData as $value) {
                    $returnData['sku']['value'][$value['attr']]['id'] = $value['id'];
                    $returnData['sku']['value'][$value['attr']]['price'] = $value['price'];
                    $returnData['sku']['value'][$value['attr']]['oprice'] = $value['oprice'];
                    $returnData['sku']['value'][$value['attr']]['groupprice'] = $value['groupprice'];
                    $returnData['sku']['value'][$value['attr']]['stock'] = $value['stock'];
                }
            }
        } else {
            $where = array(
                'id' => $skuId,
                'rid' => $gid
            );

            $returnData['sku'] = ResourceProductSku::where($where)->column('id, attr, price, groupprice, stock');
        }

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }
}
