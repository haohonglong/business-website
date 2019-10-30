<?php

namespace app\admincp\controller;

use app\admincp\model\Attachment;
use OSS\Core\OssException;
use OSS\OssClient;
use think\Cache;
use think\Config;
use think\Db;
use think\Request;
use app\admincp\model\App;
use app\admincp\model\Setting;


class Ajax extends Base {

    public function tcCreatSign() {

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $setting = new SettingInfo();
        $settingInfo = $setting->getSetting($appId);

        $secret_id = $settingInfo['videoTCAppid'];
        $secret_key = $settingInfo['videoTCKey'];

        // 确定签名的当前时间和失效时间
        $current = time();
        $expired = $current + 86400;  // 签名有效期：1天

        // 向参数列表填入参数
        $arg_list = array(
            "secretId" => $secret_id,
            "currentTimeStamp" => $current,
            "expireTime" => $expired,
            "random" => rand());

        // 计算签名
        $orignal = http_build_query($arg_list);
        $signature = base64_encode(hash_hmac('SHA1', $orignal, $secret_key, true).$orignal);

        echo json_encode($signature, JSON_UNESCAPED_UNICODE);

    }

    public function upload() {

        if (request()->isPost()) {
            $appInfo = new App();
            $loginInfo = $appInfo->getLoginInfo();

            $openId = $loginInfo['openId'];
            $appId = $loginInfo['appId'];

            $endpoint = config('oss.endpoint_internet');
            $bucket = config('oss.bucket');
            $accessId = config('oss.access_id');
            $accessSecret = config('oss.access_secret');
            $ossHost = config('oss.cdn_host');

            $file = request()->file('file');

            $file->validate(['size'=>5*1024*1024, 'ext'=>'jpg,jpeg,png,gif']);
            $filePath = $file->getRealPath();
            $content = file_get_contents($filePath);

            $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);

            $date = Date('Y').'/'.Date('m');
            $folder = "$date/";
            $fileName = $this->createRandomStr(32).'.'.$ext;
            $object = $folder.$fileName;

            if (!$file->check()) {
                return [
                    'error' => 1,
                    'msg' => $file->getError()
                ];
            }

            try {
                $ossClient = new OssClient($accessId, $accessSecret, $endpoint);
                $result = $ossClient->putObject($bucket, $object, $content);

                $postData = array(
                    'appid' => $appId,
                    'filename' => $object
                );

                $sqlData = Attachment::create($postData);

            } catch (OssException $e) {
                return [
                    'error' => 1,
                    'msg' => '上传失败'
                ];
            }

            return [
                'state' => 'SUCCESS',
                'id' => $sqlData['id'],
                'url' => $ossHost.'/'.$object
            ];
        }
    }

    public function adminUser() {

        $request = Request::instance();
        $pid = $request->param('pid', '', 'intval');

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        if($appId) {

            //$updateGroup = intval($_POST['updateGroup']);
            $uid = intval($_POST['uid']);

            $where = array(
                'uid' => $uid,
                'appid' => $appId
            );

            $updateGroup = Db::name('user')->where($where)->value('admingroup');

            $update['admingroup'] = $updateGroup == 1 ? 0 : 1;

            $hiddenText = $updateGroup == 1 ? '设为管理员' : '撤销管理员';

            Db::name('user')->where($where)->update($update);
            
            echo $hiddenText;

        } else {

            echo 'error';

        }
    }

    public function delOption() {

        $request = Request::instance();
        $pid = $request->param('pid', '', 'intval');
        $optionid = $request->param('optionid', '', 'intval');

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'pid' => $pid,
            'appid' => $appId
        );

        $pollInfo = Db::name('poll')->where($where)->find();

        if($pollInfo['pid']) {
            $where = array(
                'pid' => $pid,
                'optionid' => $optionid
            );

            $update['status'] = 1;

            Db::name('polloption')->where($where)->update($update);
            echo 'success';
        } else {
            echo 'error';
        }

    }

    public function delSort() {

        $request = Request::instance();
        $pid = $request->param('sid', '', 'intval');
        
        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'sid' => $pid,
            'appid' => $appId
        );

        $update['status'] = 1;

        Db::name('sort')->where($where)->update($update);
        
        echo 'success';

    }

    public function delSpecial() {

        $request = Request::instance();
        $id = $request->param('sid', '', 'intval');
        
        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'id' => $id,
            'appid' => $appId
        );

        $update['status'] = 0;

        Db::name('special')->where($where)->update($update);
        
        echo 'success';

    }

    public function delPoll() {

        $request = Request::instance();
        $pid = $request->param('pid', '', 'intval');
        
        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'pid' => $pid,
            'appid' => $appId
        );

        $update['status'] = 1;

        Db::name('poll')->where($where)->update($update);
        
        echo 'success';

    }

    public function delLottery() {

        $request = Request::instance();
        $lid = $request->param('lid', '', 'intval');
        
        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'lid' => $lid,
            'appid' => $appId
        );

        $update['status'] = 1;

        Db::name('lottery')->where($where)->update($update);
        
        echo 'success';

    }

    public function delPrize() {

        $request = Request::instance();
        $lid = $request->param('lid', '', 'intval');
        $pid = $request->param('pid', '', 'intval');
        
        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'lid' => $lid,
            'appid' => $appId
        );

        $lotteryInfo = Db::name('lottery')->where($where)->find();

        if($lotteryInfo) {
            $where = array(
                'pid' => $pid,
            );

            $update['status'] = 1;

            Db::name('lotteryprize')->where($where)->update($update);
        }
        
        echo 'success';

    }

    public function delCheckin() {

        $request = Request::instance();
        $cid = $request->param('cid', '', 'intval');

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'cid' => $cid,
            'appid' => $appId
        );
        $update['status'] = 1;

        Db::name('checkin')->where($where)->update($update);

        echo 'success';
    }



    public function delVideo() {

        $request = Request::instance();
        $vid = $request->param('vid', '', 'intval');
        
        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'id' => $vid,
            'appid' => $appId
        );
        $update['status'] = 0;
        Article::where($where)->update($update);
        SpecialArticle::where([
            'appid' => $appId,
            'article_id' => $vid
        ])->delete();

        echo 'success';
    }

    public function delArticle() {

        $request = Request::instance();
        $id = $request->param('id', '', 'intval');

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'id' => $id,
            'appid' => $appId
        );

        $update['status'] = 0;
        Article::where($where)->update($update);
        SpecialArticle::where([
            'appid' => $appId,
            'article_id' => $id
        ])->delete();

        echo 'success';

    }

    public function delPic()
    {
        $id = request()->post('id', 0);

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();
        ArticleThumbnail::where([
            'appid' => $appId,
            'id' => $id
        ])->delete();

        return [
            'error' => 0,
            'msg' => '成功',
        ];
    }

    public function setCover()
    {
        $ids = request()->post('ids/a', []);
        $articleId = request()->post('articleId', 0);

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();
        ArticleThumbnail::where([
            'appid' => $appId,
            'article_id' => $articleId
        ])->update(['is_cover' => 0]);

        foreach ($ids as $key => $id) {
            if ($key > 0) {continue;}
            $model = ArticleThumbnail::where([
                'appid' => $appId,
                'id' => $id
            ])->find();
            $model->is_cover = 1;
            $model->save();

            Article::where([
                'appid' => $appId,
                'id' => $model->article_id
            ])->update(['cover' => $model->thumbnail_url]);
        }

        return [
            'error' => 0,
            'msg' => '成功',
        ];
    }

    public function savePic()
    {
        $articleId = request()->post('articleId', 0);
        $url = request()->post('url', 0);

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $count = ArticleThumbnail::where([
            'appid' => $appId,
            'article_id' => $articleId
        ])->count();
        $isCover = $count ? 0 : 1;
        $model = ArticleThumbnail::create([
            'appid' => $appId,
            'article_id' => $articleId,
            'thumbnail_url' => $url,
            'is_cover' => $isCover
        ]);

        if ($isCover) {
            Article::where([
                'appid' => $appId,
                'id' => $articleId
            ])->update(['cover' => $url]);
        }

        $data = [
            'id' => $model->id,
            'url' => $model->thumbnail_url
        ];

        return [
            'error' => 0,
            'msg' => '成功',
            'data' => $data
        ];
    }

    public function getArticleList()
    {
        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where['appid'] = $appId;
        $where['status'] = 1;

        $pageSize = Config::get('paginate.list_rows');
        $list = Article::where($where)->order('id', 'desc')->paginate($pageSize, false, [
            'path'=>'javascript:ajaxPage([PAGE]);'
        ]);

        $articleList = $list->items();
        foreach ($articleList as $key => $val) {
            $val['cover'] = getImageViewUrl($val['cover'], 60, 36);
            $val['resource_type'] = Article::getResourceType($val['resource_type']);
            $articleList[$key] = $val;
        }
        $total = $list->total();
        $page = $list->render();

        $sort = new Sort();
        $sortData = $sort->getSort($appId, 'article');

        $sortList = array();

        foreach($sortData as $sort) {
            $sortList[$sort['sid']] = $sort['name'];
        }

        $data = [
            'list' => $articleList,
            'page' => $page
        ];

        return [
            'error' => 0,
            'msg' => '成功',
            'data' => $data
        ];
    }

    public function specialArticleSave()
    {
        $ids = request()->post('ids/a', []);
        $specialId = request()->post('specialId', 0);

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        foreach ($ids as $id) {
            $model = SpecialArticle::where([
                'appid' => $appId,
                'special_id' => $specialId,
                'article_id' => $id
            ])->find();
            if (!$model) {
                SpecialArticle::create([
                    'appid' => $appId,
                    'special_id' => $specialId,
                    'article_id' => $id
                ]);
                Special::where([
                    'appid' => $appId,
                    'id' => $specialId
                ])->setInc('resource_count');
                Special::where([
                    'appid' => $appId,
                    'id' => $specialId
                ])->update(['update_time' => date('Y-m-d H:i:s')]);
            }
        }

        $redisKey = 'special:index:'.$appId;
        Cache::rm($redisKey);
        Cache::clear('specialArticle');

        return [
            'error' => 0,
            'msg' => '成功'
        ];
    }

    public function delSpecialArticle()
    {
        $id = request()->post('id', 0);
        $specialId = request()->post('specialId', 0);

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();
        $result = SpecialArticle::where([
            'appid' => $appId,
            'id' => $id
        ])->delete();
        if ($result) {
            Special::where([
                'appid' => $appId,
                'id' => $specialId
            ])->setDec('resource_count');
        }

        return [
            'error' => 0,
            'msg' => '成功'
        ];
    }

    /*

    public function delSpecial()
    {
        $request = Request::instance();
        $id = $request->param('id', '', 'intval');

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'id' => $id,
            'appid' => $appId
        );
        $update['status'] = 0;
        Special::where($where)->update($update);
        SpecialArticle::where([
            'appid' => $appId,
            'special_id' => $id
        ])->delete();

        return [
            'error' => 0,
            'msg' => '成功'
        ];
    }
    */

    public function delAdvert()
    {
        $request = Request::instance();
        $id = $request->param('id', '', 'intval');

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where = array(
            'id' => $id,
            'appid' => $appId
        );
        Advert::where($where)->delete();

        return [
            'error' => 0,
            'msg' => '成功'
        ];
    }

    public function getLinkResource()
    {
        $linkType = request()->post('linkType', 0);

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $where['appid'] = $appId;
        $where['status'] = 1;
        $where['resource_type'] = $linkType;

        $list = Article::where($where)->order('id', 'desc')->limit(50)->field(['id', 'title'])->select();

        return [
            'error' => 0,
            'msg' => '成功',
            'data' => $list
        ];
    }

    public function recommend()
    {
        $id = request()->post('articleId', 0);

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        $model = Article::where([
            'appid' => $appId,
            'id' => $id
        ])->find();
        if (!$model) {
            return ['error'=> 1, 'msg' => '参数错误'];
        }
        $model->recommend = 1 - $model->recommend;
        if (!$model->recommend) {
            $model->displayorder = 0;
        }
        $model->save();
        $msg = $model->recommend ? '取消' : '置顶';

        $redisKey = 'articlecount:index:'.$appId;
        Cache::rm($redisKey);
        $redisKey = 'articlelist:index:'.$appId.':1';
        Cache::rm($redisKey);

        return ['error'=> 0, 'msg' => $msg];
    }

    public function itemSort()
    {
        $ids = request()->post('ids/a', []);
        $moduleType = request()->post('moduleType', '');

        $appInfo = new AppInfo();
        $appId = $appInfo->getAppId();

        switch ($moduleType) {
            case 'Video':
            case 'Article':
                foreach ($ids as $key => $id) {
                    Article::where([
                        'appid' => $appId,
                        'id' => $id
                    ])->update(['displayorder' => $key+1]);
                }
                break;
            case 'Special':
                foreach ($ids as $key => $id) {
                    Special::where([
                        'appid' => $appId,
                        'id' => $id
                    ])->update(['displayorder' => $key+1]);
                }
                break;
        }

        return ['error' => 0, 'msg' => '成功'];
    }

    public function selectSpecial() 
    {
        $id = request()->post('sortId', 0);
        $module = request()->post('module', 'video');

        $where = array(
            'module' => $module,
            'status' => 1,
            'sort' => $id
        );

        $specialList = \app\admincp\model\Special::where($where)->order(['displayorder'=>'asc','id'=>'desc'])->select();

        return $specialList;

    }

    private function createRandomStr($length){ 
        $str = array_merge(range(0,9), range('a','z'), range('A','Z')); 
        shuffle($str); 
        $str = implode('',array_slice($str,0,$length)); 
        return $str; 
    }

    private function getConfig()
    {
        $config = [
            "imageActionName" => "uploadimage", /* 执行上传图片的action名称 */
            "imageFieldName" => "file", /* 提交的图片表单名称 */
            "imageMaxSize" => 2048000, /* 上传大小限制，单位B */
            "imageAllowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp"], /* 上传图片格式显示 */
            "imageUrlPrefix" => "", /* 图片访问路径前缀 */
        ];

        return json($config);
    }


}
