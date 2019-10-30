<?php
namespace app\api\controller;
use app\api\model\Resource;
use app\api\model\Setting;
use think\Config;
use think\Request;
use think\Cache;
use library\Helper;

class Index
{
    public function index()
    {
    	$request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');

        $page = $request->param('page', 1, 'intval');
        $pageSize = 10;

        $where = array(
            'appid' => $appId,
            'status' => 0,
            // 'istop' => 1
            'goodssort' => 2
        );

        $returnData['total'] = Resource::where($where)->count();
        $returnData['page'] = $page;
        $returnData['size'] = $pageSize;

        $field = array(
            'id',
            'sort', 
            'categoryid', 
            'title',
            'cover', 
            'pcover',
            'summary', 
            'url', 
            'price', 
            'stock', 
            'salecount', 
            'views', 
            'replies', 
            'likes', 
            'isrecommend',
            'goodssort',
            'picmode'
        );

        $resourceList = Resource::with('lottery')->where($where)->page($page, $pageSize)->order('istop desc,create_time desc')->field($field)->select();

        // $where = array(
        //     'appid' => $appId,
        //     'status' => 0,
        //     'keyword' => 'swiper'
        // );

        // $swiperData = Setting::where($where)->column('value');

        // $swiperList = array();
        // foreach ($swiperData as $key => $swiper) {
        //     $swiper = json_decode($swiper, TRUE);
        //     $swiperList[$key]['cover'] = $swiper['cover'];
        //     $swiperList[$key]['link'] = $swiper['link'];
        // }

        // $returnData['swiperList'] = $swiperList;
        foreach ($resourceList as $k=>$v) {
            $time = date("Y-m-d H:i", $v['lottery']['endtime']);
            $resourceList[$k]['lottery']['endtime'] = $time;

        }
        $returnData['list'] = $resourceList;
        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }


    public function search(Request $request) {
        $request = Request::instance();

        $userSession = $request->param('userSession', '', 'htmlspecialchars');
        $appId = $request->param('appId', '', 'htmlspecialchars');

        $kw = $request->param('keyword', '');
        $page = $request->param('page', 1, 'intval');
        $pageSize = 10;
        
        $where = array(
            'appid' => $appId,
            'status' => 0,
        );
        if ($kw) {
            $where['title'] = ['like', '%'.$kw.'%'];
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
            'stock', 
            'salecount', 
            'views', 
            'replies', 
            'likes', 
            'isrecommend',
            'goodssort',
            'picmode'
        );

        $resourceList = Resource::where($where)->page($page, $pageSize)->order('istop desc,create_time desc')->field($field)->select();

        
        $returnData['list'] = $resourceList;
        return [
            'code' => 0,
            'msg' => '成功',
            'data' => $returnData
        ];
    }

    public function rule(Request $request) {
        $appId = $request->param('appId', '', 'htmlspecialchars');
        $rule = \app\api\model\ResourceComment::where(['id' => 1])->value('message');
        $rule = Helper::replaceRichText($rule);
        return ['code' => 0, 'msg' => '成功', 'data' => $rule];
    }

    public function about(Request $request) {
        $appId = $request->param('appId', '', 'htmlspecialchars');
        $about = \app\api\model\ResourceComment::where(['id' => 2])->value('message');
        $about = Helper::replaceRichText($about);
        return ['code' => 0, 'msg' => '成功', 'data' => $about];
    }
}
